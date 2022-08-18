<?php
namespace App\Tests\Unit\UseCase\Comment;

use App\Entity\Comment;
use App\Repository\Fake\CommentRepository;
use App\UseCase\Comment\UpdateUseCase;
use PHPUnit\Framework\TestCase;

class UpdateUseCaseTest extends TestCase{
    public function testExecuteNormalCase()
    {
        $commentRepository = new CommentRepository();
        $indexUseCase = new UpdateUseCase($commentRepository);
        $comment = new Comment();
        $comment->setId(1);
        $comment->setText('new test text');
        $comment->setPostId(4);
        $indexUseCase->execute($comment);

        $fetchedComment = $commentRepository->findOneById(1);
        $this->assertEquals('new test text',$fetchedComment->getText());
        $this->assertEquals(4,$fetchedComment->getPostId());
        }
}
