<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GatewayController extends AbstractController
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $client)
    {
        $this->httpClient = $client;
    }

    #[Route('/posts', name: 'posts', methods: ['GET'])]
    public function posts_index(): Response
    {
        $serviceResponse = $this->httpClient->request('GET',$this->getParameter('post_service_url').'/posts');
        $response = new Response($serviceResponse->getContent());
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    #[Route('/posts/{id}', name: 'posts_show', methods: ['GET'])]
    public function posts_show(int $id): JsonResponse
    {
        $postServiceResponse = $this->httpClient->request('GET',$this->getParameter('post_service_url')."/posts/$id");
        $commentServiceResponse = $this->httpClient->request('GET',$this->getParameter('comment_service_url')."/comments?post_id=$id");
        $post = json_decode($postServiceResponse->getContent(),true);
        $post['comments'] = json_decode($commentServiceResponse->getContent(),true);
        return $this->json($post);
    }

    #[Route('/posts', name: 'post_store', methods: ['POST'])]
    public function posts_store(Request $request): Response
    {
//        dd($request->request->all());
        $serviceResponse = $this->httpClient->request('POST',$this->getParameter('post_service_url').'/posts',[
            'body' =>
                $request->request->all()
            ,
        ]);
        $response = new Response($serviceResponse->getContent());
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}