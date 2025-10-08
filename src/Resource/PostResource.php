<?php

namespace App\Resource;

use App\Entity\Post;
use Symfony\Component\Serializer\SerializerInterface;

class PostResource
{
    public function __construct(
        private SerializerInterface $serializer
    ) 
    {

    }

    public function postItem(Post $post): string
    {
        return $this->serializer->serialize($post, 'json', ['groups' => ['post:item']]);
    }
}
