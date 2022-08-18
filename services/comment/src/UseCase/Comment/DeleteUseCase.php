<?php

namespace App\UseCase\Comment;

use App\Entity\Comment;
use App\Repository\CommentRepositoryInterface;

final class DeleteUseCase extends BaseUseCase
{
    public function execute(int $id): bool
    {
        return $this->commentRepository->delete($id);
    }
}