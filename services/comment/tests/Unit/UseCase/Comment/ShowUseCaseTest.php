<?php
namespace App\Tests\Unit\UseCase\Comment;

use App\Repository\Fake\CommentRepository;
use App\UseCase\Comment\ShowUseCase;
use PHPUnit\Framework\TestCase;

class ShowUseCaseTest extends TestCase{
    public function testExecuteNormalCase()
    {
        $commentRepository = new CommentRepository();
        $indexUseCase = new ShowUseCase($commentRepository);
        $comment = $indexUseCase->execute(1);
        $this->assertEquals('test text 1',$comment['text']);
        $this->assertEquals(1,$comment['post_id']);
    }
}
