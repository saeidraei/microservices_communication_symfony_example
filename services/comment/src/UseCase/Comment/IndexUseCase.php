<?php

namespace App\UseCase\Comment;

use App\Entity\Comment;

final class IndexUseCase extends BaseUseCase
{
    public function execute(int $postId = null): array
    {
        if(!$postId) {
            $comments = $this->commentRepository->getAll();
        }
        else{
            $comments = $this->commentRepository->getByPostId($postId);
        }
        $data = [];
        foreach ($comments as $comment) {
            /** @var Comment $comment */
            $data[] = $comment->toArray();
        }
        return $data;
    }
}