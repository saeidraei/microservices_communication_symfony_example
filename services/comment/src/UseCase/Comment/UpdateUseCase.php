<?php

namespace App\UseCase\Comment;

use App\Entity\Comment;
use App\Repository\CommentRepositoryInterface;

final class UpdateUseCase extends BaseUseCase
{
    public function execute(Comment $comment): array
    {
        return $this->commentRepository->update($comment)->toArray();
    }
}