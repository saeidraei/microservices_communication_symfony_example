<?php

namespace App\MessageHandler;

use App\Message\PostCreated;
use App\UseCase\PostCreatedEventHandler;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class PostCreatedHandler
{
    private PostCreatedEventHandler $createdEventHandler;

    public function __construct(PostCreatedEventHandler $createdEventHandler)
    {
        $this->createdEventHandler = $createdEventHandler;
    }

    public function __invoke(PostCreated $created)
    {
        $this->createdEventHandler->execute($created);
    }
}