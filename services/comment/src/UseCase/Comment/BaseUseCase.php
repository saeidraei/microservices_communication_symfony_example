<?php
namespace App\UseCase\Comment;

use App\Repository\CommentRepositoryInterface;

abstract class BaseUseCase{
    protected CommentRepositoryInterface $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
}
