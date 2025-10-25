<?php

namespace App\Service;

use App\DTO\Input\User\StoreUserInputDTO;
use App\Entity\User;
use App\Factory\UserFactory;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserFactory $userFactory,
        private JWTTokenManagerInterface $jWTTokenManager
    )
    {
    }

    public function store(StoreUserInputDTO $userDTO): User
    {
        $user = $this->userFactory->makeUser($userDTO);

        $user = $this->userRepository->store($user);

        return $user;
    }
}