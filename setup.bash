#!/bin/bash
SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )
#create the var directories to set the permissions for them
mkdir -p "$SCRIPT_DIR"/services/post/var
mkdir -p "$SCRIPT_DIR"/services/comment/var
mkdir -p "$SCRIPT_DIR"/api-gateway/var
#set the right permissions (tested only on debian)
chmod 777 -R "$SCRIPT_DIR"/services/post/var
chmod 777 -R "$SCRIPT_DIR"/services/comment/var
chmod 777 -R "$SCRIPT_DIR"/api-gateway/var
#install composer packages
sudo docker exec post_app composer install
sudo docker exec comment_app composer install
sudo docker exec api_gateway_app composer install
#run the migrations
sudo docker exec post_app php bin/console --no-interaction doctrine:migrations:migrate
sudo docker exec comment_app php bin/console --no-interaction doctrine:migrations:migrate
#setup the exchange and bindings to queues of rabbitmq specific to this project
sudo docker exec rabbit rabbitmqadmin -u rabbitmq -p rabbitmq declare exchange name=post_created type=fanout
sudo docker exec rabbit rabbitmqadmin -u rabbitmq -p rabbitmq declare queue name=post_queue durable=true
sudo docker exec rabbit rabbitmqadmin -u rabbitmq -p rabbitmq declare queue name=comment_queue durable=true
sudo docker exec rabbit rabbitmqadmin -u rabbitmq -p rabbitmq declare binding source="post_created" destination_type="queue" destination="post_queue"
sudo docker exec rabbit rabbitmqadmin -u rabbitmq -p rabbitmq declare binding source="post_created" destination_type="queue" destination="comment_queue"


