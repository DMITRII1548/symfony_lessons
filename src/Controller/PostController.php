<?php

namespace App\Controller;

use App\DTOValidator\PostDTOValidator;
use App\Entity\Post;
use App\Factory\PostFactory;
use App\ResponseBuilder\PostResponseBuilder;
use App\Service\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class PostController extends AbstractController
{
    public function __construct(
        private PostService $postService,   
        private PostResponseBuilder $postResponseBuilder,
        private PostDTOValidator $postDTOValidator,
        private PostFactory $postFactory,
    )
    {
        
    }

    #[Route('/api/posts', name: 'posts_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $posts = $this->postService->index();

        return $this->postResponseBuilder->indexPostResponse($posts);
    }

    #[Route('/api/posts/{post}', name: 'posts_show', methods: ['GET'])]
    public function show(Post $post): JsonResponse
    {
        return $this->postResponseBuilder->showPostResponse($post);
    }

    
    #[Route('/api/posts', name: 'posts_store', methods: ['POST'])]
    public function store(
        Request $request,
    ): JsonResponse
    {
        $data = json_decode($request->getContent(), 'true');

        $post = $this->postFactory->makeStorePostInputDTO($data);

        $this->postDTOValidator->validate($post);
        
        $post = $this->postService->store($post);

        return $this->postResponseBuilder->storePostResponse($post);
    }
}
