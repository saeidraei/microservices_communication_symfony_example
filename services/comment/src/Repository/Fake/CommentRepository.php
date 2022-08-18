<?php

namespace App\Repository\Fake;

use App\Entity\Comment;
use App\Repository\CommentRepositoryInterface;
use Symfony\Component\DependencyInjection\Attribute\When;

#[When(env: 'test')]
class CommentRepository implements CommentRepositoryInterface
{

    private array $fakeData = [];

    private function initData()
    {
        $this->fakeData = [
            (new Comment())->setId(1)->setText('test text 1')->setPostId(1),
            (new Comment())->setId(2)->setText('test text 2')->setPostId(1)
        ];
    }

    public function __construct()
    {
        $this->initData();
    }

    public function findOneById(int $id): ?Comment
    {
        foreach ($this->fakeData as $model) {
            if ($model->getId() == $id) {
                return $model;
            }
        }
        return null;
    }

    public function add(Comment $comment): ?Comment
    {
        $comment->setId(999);
        $this->fakeData[] = $comment;
        return $comment;
    }

    public function getAll(): array
    {
        return $this->fakeData;
    }

    public function update(Comment $comment): ?Comment
    {
        foreach ($this->fakeData as &$item){
            if($item->getId() == $comment->getId()){
                $item = $comment;
                return $comment;
            }
        }

        return null;
    }

    public function delete(int $id): bool
    {
        foreach ($this->fakeData as $key => &$item){
            if($item->getId() == $id){
                unset($this->fakeData[$key]);

                return true;
            }
        }
        return false;
    }

    public function getByPostId(int $postId): array
    {
        $result = [];
        foreach ($this->fakeData as $item){
            if($item->getPostId() == $postId){
                $result[] = $item;
            }
        }
        return $result;
    }
}