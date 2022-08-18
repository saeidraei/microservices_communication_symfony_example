<?php

namespace App\UseCase\Post;

use App\Entity\Post;
use App\Message\PostCreated;
use App\Repository\PostRepositoryInterface;

class PostCreatedEventHandler
{

    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function execute(PostCreated $postCreated): Post
    {
        //lets pretend this takes time
        sleep(10);
        $post = $postCreated->getPost();
        $post->setMinedText(md5(rand()));
        return $this->postRepository->update($post);
    }

}
