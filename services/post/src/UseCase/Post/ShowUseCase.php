<?php

namespace App\UseCase\Post;

use App\Entity\Post;
use App\Exceptions\ModelNotFound;

final class ShowUseCase extends BaseUseCase
{
    /**
     * @throws ModelNotFound
     */
    public function execute(int $id): array
    {
        $post = $this->postRepository->findOneById($id);
        if(!$post){
            throw new ModelNotFound();
        }
        return $post->toArray();
    }
}