#!/bin/bash
SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )
mkdir -p "$SCRIPT_DIR"/services/post/var
mkdir -p "$SCRIPT_DIR"/services/comment/var
mkdir -p "$SCRIPT_DIR"/api-gateway/var
#
chmod 777 -R "$SCRIPT_DIR"/services/post/var
chmod 777 -R "$SCRIPT_DIR"/services/comment/var
chmod 777 -R "$SCRIPT_DIR"/api-gateway/var

sudo docker exec post_app composer install
sudo docker exec comment_app composer install
sudo docker exec api_gateway_app composer install

sudo docker exec post_app php bin/console --no-interaction doctrine:migrations:migrate
sudo docker exec comment_app php bin/console --no-interaction doctrine:migrations:migrate