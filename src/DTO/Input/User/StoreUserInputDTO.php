<?php

namespace App\DTO\Input\User;

use App\DTO\Input\Inteface\InputDTOInterface;
use Symfony\Component\Validator\Constraints as Assert;

class StoreUserInputDTO implements InputDTOInterface
{
    #[Assert\NotBlank(allowNull: false, normalizer: 'trim')]
    #[Assert\Email()]
    public ?string $email;

    #[Assert\NotBlank(allowNull: false, normalizer: 'trim')]
    #[Assert\PasswordStrength()]
    public ?string $password;
}