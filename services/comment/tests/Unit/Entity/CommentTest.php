<?php
namespace App\Test\Unit\Entity;

use App\Entity\Comment;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase{
    public function testSetAndGet()
    {
        $comment = new Comment();
        $comment->setText('test title');
        $comment->setPostId(2);
        $this->assertEquals('test title', $comment->getText());
        $this->assertEquals(2, $comment->getPostId());
    }
}