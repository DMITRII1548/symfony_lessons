<?php

namespace App\Command;

use App\Entity\Category;
use App\Entity\Post;
use App\Factory\PostFactory;
use App\Repository\PostRepository;
use App\Resource\PostResource;
use App\ResponseBuilder\PostResponseBuilder;
use App\Service\PostService;
use App\Validator\PostValidator;
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
        private PostService $postService,
        private PostValidator $postValidator,
        private PostResponseBuilder $postResponseBuilder,
        private PostFactory $postFactory,
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // $posts = $this->postRepository->findAll();


        $data = [
            'title' => 'JS is my second language',
            'description' => 'desc',
            'content' => 'content',
            'published_at' => new DateTimeImmutable('2020-12-20'),
            'status' => 2,
            'category_id' => 2,
        ];

        
        $post = $this->postFactory->makeStorePostInputDTO($data);

        $this->postValidator->validate($post);
        
        $post = $this->postService->store($post);

        $response = $this->postResponseBuilder->storePostResponse($post);
        dd($response);

        return Command::SUCCESS;
    }
}
