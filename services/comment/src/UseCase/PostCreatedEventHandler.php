<?php

namespace App\UseCase;

use App\Entity\Comment;
use App\Entity\Post;
use App\Message\PostCreated;
use App\Repository\CommentRepositoryInterface;
use App\Repository\PostRepositoryInterface;

class PostCreatedEventHandler
{

    private CommentRepositoryInterface $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function execute(PostCreated $postCreated): Comment
    {
        //lets pretend this takes time
        sleep(2);
        $post = $postCreated->getPost();
        $comment = new Comment();
        $comment->setPostId($post->getId());
        $comment->setText("copy of post with id={$post->getId()}:'{$post->getTitle()}'");
        return $this->commentRepository->add($comment);
    }

}
