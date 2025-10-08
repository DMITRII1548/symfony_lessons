<?php

namespace App\Factory;

use App\DTO\Input\Post\PostOutputDTO;
use App\DTO\Input\Post\StorePostInputDTO;
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
    public function makePost(StorePostInputDTO $storePostInputDTO): Post
    {
        $post = new Post();

        $category = $this->em->getReference(Category::class, $storePostInputDTO->categoryId);

        $post->setTitle($storePostInputDTO->title);
        $post->setDescription($storePostInputDTO->description);
        $post->setContent($storePostInputDTO->content);
        $post->setPublishedAt($storePostInputDTO->publishedAt);
        $post->setStatus($storePostInputDTO->status);
        $post->setCategory($category);

        return $post;
    }

    /**
     * @param array<string, mixed> $data
     */
    public function makeStorePostInputDTO(array $data): StorePostInputDTO
    {
        $post = new StorePostInputDTO();

        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->content = $data['content'];
        $post->publishedAt = $data['published_at'];
        $post->status = $data['status'];
        $post->categoryId = $data['category_id'];

        return $post;
    }

    public function makePostOutputDTO(Post $post): PostOutputDTO
    {
        $postOutputDTO = new PostOutputDTO();

        $postOutputDTO->id = $post->getId();
        $postOutputDTO->title = $post->getTitle();
        $postOutputDTO->description = $post->getDescription();
        $postOutputDTO->content = $post->getContent();
        $postOutputDTO->publishedAt = $post->getPublishedAt();
        $postOutputDTO->status = $post->getStatus();
        $postOutputDTO->category = $post->getCategory();

        return $postOutputDTO;
    }
}