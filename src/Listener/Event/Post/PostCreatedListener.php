<?php

namespace App\Listener\Event\Post;

use App\Event\Post\PostCreatedEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(PostCreatedEvent::NAME, 'handle')]
class PostCreatedListener
{
    public function handle(PostCreatedEvent $postCreatedEvent): void
    {
        dd($postCreatedEvent->getPost());
    }
}