<?php

namespace App\UseCase\Comment;

use App\Entity\Comment;
use App\Exceptions\ModelNotFound;

final class ShowUseCase extends BaseUseCase
{
    public function execute(int $id): array
    {
        $comment = $this->commentRepository->findOneById($id);
        if(!$comment){
            throw new ModelNotFound();
        }
        return $comment->toArray();
    }
}