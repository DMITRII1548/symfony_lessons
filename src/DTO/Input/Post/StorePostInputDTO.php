<?php

namespace App\DTO\Input\Post;

use App\Entity\Category;
use App\Validator\Constraint\EntiryExists;
use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

class StorePostInputDTO
{
    #[Assert\NotBlank(allowNull: false, normalizer: 'trim')]
    #[Assert\Length(min: 2, max: 255)]
    public ?string $title = null;

    #[Assert\NotBlank(allowNull: true, normalizer: 'trim')]
    public ?string $description = null;

    #[Assert\NotBlank(allowNull: true, normalizer: 'trim')]
    public ?string $content = null;

    #[Assert\Type(DateTimeImmutable::class)]
    public ?\DateTimeImmutable $publishedAt = null;

    #[Assert\NotNull]
    #[Assert\Type('integer')]
    public ?int $status = 1;

    #[EntiryExists(Category::class)]
    #[Assert\NotNull]
    public ?int $categoryId = null;
}