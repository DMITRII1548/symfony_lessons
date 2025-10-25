<?php 

namespace App\Event\Post;

use App\Entity\Post;

class PostCreatedEvent
{
    public const NAME = 'PostCreatedEvent';

    public function __construct(
        private Post $post
    )
    {
    }

    public function getPost(): Post
    {
        return $this->post;
    }
}