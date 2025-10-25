<?php

namespace App\MessageHandler;

use App\Message\SomeMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class SomeMessageHandler
{
    public function __invoke(SomeMessage $message): void
    {
        dump($message->getName());
    }
}
