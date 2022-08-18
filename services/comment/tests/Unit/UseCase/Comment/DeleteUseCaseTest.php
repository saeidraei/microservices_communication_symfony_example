<?php
namespace App\Tests\Unit\UseCase\Comment;

use App\Entity\Comment;
use App\Repository\Fake\CommentRepository;
use App\UseCase\Comment\DeleteUseCase;
use App\UseCase\Comment\StoreUseCase;
use App\UseCase\Comment\IndexUseCase;
use App\UseCase\Comment\UpdateUseCase;
use PHPUnit\Framework\TestCase;

class DeleteUseCaseTest extends TestCase{
    public function testExecuteNormalCase()
    {
        $commentRepository = new CommentRepository();
        $indexUseCase = new DeleteUseCase($commentRepository);

        $indexUseCase->execute(1);

        $this->assertNull($commentRepository->findOneById(1));
        }
}
