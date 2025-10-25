<?php

namespace App\DTO\Output\User;

use Symfony\Component\Serializer\Attribute\Groups;

class UserOutputDTO
{
    #[Groups('user:item')]
    public ?int $id = null;

    #[Groups('user:item')]
    public ?string $email = null;
}