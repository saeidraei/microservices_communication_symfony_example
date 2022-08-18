<?php
namespace App\Messenger;

interface MessengerInterface{
    public function publish(object $message);
}