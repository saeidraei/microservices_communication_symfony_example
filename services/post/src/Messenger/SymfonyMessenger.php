<?php

namespace App\Messenger;

use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyMessenger implements MessengerInterface{

    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function publish(object $message)
    {
        $this->messageBus->dispatch($message);
    }
}