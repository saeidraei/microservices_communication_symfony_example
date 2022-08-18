<?php

namespace App\Repository;

use App\Entity\Comment;

interface CommentRepositoryInterface{
    public function getAll():array;
    public function getByPostId(int $postId):array;
    public function add(Comment $comment): ?Comment;
    public function findOneById(int $id):?Comment;
    public function update(Comment $comment): ?Comment;
    public function delete(int $id): bool;
}
