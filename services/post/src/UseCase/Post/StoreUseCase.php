<?php

namespace App\UseCase\Post;

use App\Entity\Post;
use App\Message\PostCreated;
use App\Messenger\MessengerInterface;
use App\Repository\PostRepositoryInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class StoreUseCase
{
    private MessengerInterface $messenger;
    protected PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository, MessengerInterface $messenger)
    {
        $this->postRepository = $postRepository;
        $this->messenger = $messenger;
    }

    public function execute(Post $post): array
    {
        $result = $this->postRepository->add($post)->toArray();
        $this->messenger->publish(new PostCreated($post));
        return $result;
    }
}