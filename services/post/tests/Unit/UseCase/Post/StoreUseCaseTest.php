<?php

namespace App\Tests\Unit\UseCase\Post;

use App\Entity\Post;
use App\Messenger\Fake\TestMessenger;
use App\Repository\Fake\PostRepository;
use App\UseCase\Post\StoreUseCase;
use App\UseCase\Post\IndexUseCase;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\MessageBusInterface;

class StoreUseCaseTest extends TestCase
{

    public function testExecuteNormalCase()
    {
        $postRepository = new PostRepository();
        $messenger = new TestMessenger();
        $indexUseCase = new StoreUseCase($postRepository, $messenger);
        $post = new Post();
        $post->setTitle('new test title');
        $post->setBody('new test body');
        //this simulates the queue by calling this callback
        $messenger->assertCallback = function ($message){
            $this->assertEquals('new test title',$message->getPost()->getTitle());
            $this->assertEquals('new test body',$message->getPost()->getBody());
        };
        $indexUseCase->execute($post);

        $fetchedPost = $postRepository->findOneById($post->getId());
        $this->assertEquals('new test title', $fetchedPost->getTitle());
        $this->assertEquals('new test body', $fetchedPost->getBody());
    }
}
