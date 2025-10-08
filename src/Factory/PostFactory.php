<?php

namespace App\Factory;

use App\Entity\Category;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;

class PostFactory
{
    public function __construct(
        private EntityManagerInterface $em,
    )
    {
        
    }

    /**
     * @param array<string, mixed> $data
     */
    public function makePost(array $data): Post
    {
        $post = new Post();

        $category = $this->em->getReference(Category::class, $data['category_id']);

        $post->setTitle($data['title']);
        $post->setDescription($data['description']);
        $post->setContent($data['content']);
        $post->setPublishedAt($data['published_at']);
        $post->setStatus($data['status']);
        $post->setCategory($data['category']);

        return $post;
    }
}