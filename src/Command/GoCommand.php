<?php

namespace App\Command;

use App\Factory\PostFactory;
use App\ResponseBuilder\PostResponseBuilder;
use App\Service\PostService;
use App\DTOValidator\DTOValidator;
use App\Entity\Post;
use App\Event\Post\PostCreatedEvent;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

#[AsCommand(
    name: 'go',
    description: 'Add a short description for your command',
)]
class GoCommand extends Command
{
    public function __construct(
        private PostService $postService,
        private DTOValidator $DTOValidator,
        private PostResponseBuilder $postResponseBuilder,
        private PostFactory $postFactory,
        private EntityManagerInterface $em,
        private EventDispatcherInterface $eventDispatcher
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $post = $this->em->getRepository(Post::class)->find(10);
        $post->setTitle('new title');
        $this->em->persist($post);

        $this->em->flush();

        $this->eventDispatcher->dispatch(new PostCreatedEvent($post), PostCreatedEvent::NAME);
        // $posts = $this->postRepository->findAll();


        // $data = [
        //     'title' => 'JS is my second language',
        //     'description' => 'desc',
        //     'content' => 'content',
        //     'published_at' => new DateTimeImmutable('2020-12-20'),
        //     'status' => 2,
        //     'category_id' => 9999,
        // ];

        
        // $post = $this->postFactory->makeStorePostInputDTO($data);

        // $this->DTOValidator->validate($post);
        
        // $post = $this->postService->store($post);

        // $response = $this->postResponseBuilder->storePostResponse($post);
        // dd($response);

        return Command::SUCCESS;
    }
}
