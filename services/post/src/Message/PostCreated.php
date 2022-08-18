<?php

namespace App\Message;

use App\Entity\Post;

class PostCreated
{
    private Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getPost(): Post
    {
        return $this->post;
    }
}