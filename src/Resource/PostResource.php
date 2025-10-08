<?php

namespace App\Resource;

use App\DTO\Input\Post\PostOutputDTO;
use Symfony\Component\Serializer\SerializerInterface;

class PostResource
{
    public function __construct(
        private SerializerInterface $serializer
    ) 
    {

    }

    public function postItem(PostOutputDTO $post): string
    {
        return $this->serializer->serialize($post, 'json', ['groups' => ['post:item']]);
    }
}
