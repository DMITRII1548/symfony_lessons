<?php

namespace App\Command;

use App\Entity\Category;
use App\Entity\Post;
use App\Repository\PostRepository;
use App\Service\PostService;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsCommand(
    name: 'go',
    description: 'Add a short description for your command',
)]
class GoCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private PostService $postService,
        private ValidatorInterface $validator,
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // $posts = $this->postRepository->findAll();


        $data = [
            'title' => 'PHP is my first language',
            'description' => 'desc',
            'content' => 'content',
            'published_at' => new DateTimeImmutable('2020-12-20'),
            'status' => 2,
            'category_id' => 2,
        ];

        $category = $this->em->getReference(Category::class, $data['category_id']);
        $post = new Post();
        $post->setTitle($data['title']);
        $post->setDescription($data['description']);
        $post->setContent($data['content']);
        $post->setPublishedAt($data['published_at']);
        $post->setStatus($data['status']);
        $post->setCategory($category);

        $errors = $this->validator->validate($post);
        dd($errors);
        
        $this->postService->store($post);

        return Command::SUCCESS;
    }
}
