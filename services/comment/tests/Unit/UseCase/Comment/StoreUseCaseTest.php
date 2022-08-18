<?php

namespace App\Tests\Unit\UseCase\Comment;

use App\Entity\Comment;
use App\Repository\Fake\CommentRepository;
use App\UseCase\Comment\StoreUseCase;
use PHPUnit\Framework\TestCase;

class StoreUseCaseTest extends TestCase
{
    public function testExecuteNormalCase()
    {
        $commentRepository = new CommentRepository();
        $indexUseCase = new StoreUseCase($commentRepository);
        $comment = new Comment();
        $comment->setText('new test text');
        $comment->setPostId(3);
        $indexUseCase->execute($comment);

        $fetchedComment = $commentRepository->findOneById($comment->getId());
        $this->assertEquals('new test text', $fetchedComment->getText());
        $this->assertEquals(3, $fetchedComment->getPostId());
    }
}
