<?php
namespace App\Tests\Unit\UseCase\Comment;

use App\Repository\Fake\CommentRepository;
use App\UseCase\Comment\IndexUseCase;
use PHPUnit\Framework\TestCase;

class IndexUseCaseTest extends TestCase{
    public function testExecuteNormalCase()
    {
        $commentRepository = new CommentRepository();
        $indexUseCase = new IndexUseCase($commentRepository);
        $comments = $indexUseCase->execute();
        $this->assertCount(2,$comments);
        $this->assertEquals('test text 1',$comments[0]['text']);
        $this->assertEquals(1,$comments[0]['post_id']);
        $this->assertEquals('test text 2',$comments[1]['text']);
        $this->assertEquals(1,$comments[1]['post_id']);
    }
}
