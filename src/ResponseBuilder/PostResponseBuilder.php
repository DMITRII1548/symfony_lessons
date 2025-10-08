<?php

namespace App\ResponseBuilder;

use App\Entity\Post;
use App\Resource\PostResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class PostResponseBuilder
{
    public function __construct(
        private PostResource  $postResource
    )
    {
        
    }

    public function storePostResponse(
        Post $post, 
        int $status = 201, 
        array $headers = [], 
        bool $isJson = true,
    ): JsonResponse
    {
        $postResource = $this->postResource->postItem($post);

        return new JsonResponse($postResource, $status, $headers, $isJson);
    }
}