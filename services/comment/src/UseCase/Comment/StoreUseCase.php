<?php

namespace App\UseCase\Comment;

use App\Entity\Comment;

final class StoreUseCase extends BaseUseCase
{

    public function execute(Comment $comment): array
    {
        return $this->commentRepository->add($comment)->toArray();
    }
}