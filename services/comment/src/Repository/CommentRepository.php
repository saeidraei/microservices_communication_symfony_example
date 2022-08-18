<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Comment>
 *
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository implements CommentRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function add(Comment $comment): Comment
    {
        $this->getEntityManager()->persist($comment);

        $this->getEntityManager()->flush();

        return $comment;
    }

    public function remove(Comment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function getAll(): array
    {
        return $this->findAll();
    }

    public function findOneById(int $id): ?Comment
    {
        return $this->find($id);
    }

    public function update(Comment $comment): ?Comment
    {
        //this code may seem odd but this is how doctrine works
        $originalComment = $this->findOneById($comment->getId());
        $originalComment->setPostId($comment->getPostId());
        $originalComment->setText($comment->getText());
        $this->getEntityManager()->flush();

        return $comment;
    }

    public function delete(int $id): bool
    {
        $comment = $this->findOneById($id);
        $this->getEntityManager()->remove($comment);
        $this->getEntityManager()->flush();

        //just returning true for now
        return true;
    }

    public function getByPostId(int $postId): array
    {
        return $this->findBy(['post_id' => $postId]);
    }
}
