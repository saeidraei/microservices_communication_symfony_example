<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Exceptions\ModelNotFound;
use App\UseCase\Comment\DeleteUseCase;
use App\UseCase\Comment\StoreUseCase;
use App\UseCase\Comment\IndexUseCase;
use App\UseCase\Comment\ShowUseCase;
use App\UseCase\Comment\UpdateUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comments', name: 'comment_index', methods: ['GET'])]
    public function index(Request $request,IndexUseCase $indexUseCase): JsonResponse
    {
        $postId = $request->get('post_id');
        return $this->json($indexUseCase->execute($postId));
    }

    #[Route('/comments/{id}', name: 'comment_show', methods: ['get'])]
    public function show(int $id, ShowUseCase $showUseCase)
    {
        try {
            return $this->json($showUseCase->execute($id));
        } catch (ModelNotFound $e) {
            throw $this->createNotFoundException();
        }
    }

    #[Route('/comments', name: 'comment_store', methods: ['POST'])]
    public function store(Request $request, StoreUseCase $storeUseCase): JsonResponse
    {
        $comment = new Comment();
        $comment->setText($request->get('text'));
        $comment->setPostId($request->get('post_id'));
        return $this->json($storeUseCase->execute($comment));
    }

    #[Route('/comments/{id}', name: 'comment_update', methods: ['PUT'])]
    public function update(int $id, Request $request, UpdateUseCase $updateUseCase): JsonResponse
    {
        $comment = new Comment();
        $comment->setId($id);
        $comment->setText($request->get('text'));
        $comment->setPostId($request->get('post_id'));
        return $this->json($updateUseCase->execute($comment));
    }

    #[Route('/comments/{id}', name: 'comment_delete', methods: ['DELETE'])]
    public function delete(int $id, DeleteUseCase $deleteUseCase): JsonResponse
    {

        return $this->json(['success' => $deleteUseCase->execute($id)]);
    }

}
