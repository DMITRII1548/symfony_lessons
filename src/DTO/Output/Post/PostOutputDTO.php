<?php

namespace App\DTO\Input\Post;

use App\Entity\Category;
use DateTimeImmutable;
use Symfony\Component\Serializer\Attribute\Groups;

class PostOutputDTO
{
    #[Groups('post:item')]
    public ?int $id = null;

    #[Groups('post:item')]
    public ?string $title = null;

    #[Groups('post:item')]
    public ?string $description = null;

    #[Groups('post:item')]
    public ?string $content = null;

    #[Groups('post:item')]
    public ?\DateTimeImmutable $publishedAt = null;

    #[Groups('post:item')]
    public ?int $status = 1;

    #[Groups('post:item')]
    public ?Category $category = null;
}