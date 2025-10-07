<?php

namespace App\Service;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;

class PostService
{
    public function __construct(
        private PostRepository $postRepository,

    )
    {
        
    }

    public function store(Post $post): Post
    {
        return $this->postRepository->store($post);
    }
}