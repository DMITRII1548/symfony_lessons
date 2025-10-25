<?php

namespace App\DTO\Output\User;

use Symfony\Component\Serializer\Attribute\Groups;

class RegisterUserOutputDTO
{
    #[Groups('user:item')]
    public ?int $id = null;

    #[Groups('user:item')]
    public ?string $email = null;

    #[Groups('user:item')]
    public ?string $token = null;
}