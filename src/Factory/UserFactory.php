<?php

namespace App\Factory;

use App\DTO\Input\User\StoreUserInputDTO;
use App\DTO\Output\User\RegisterUserOutputDTO;
use App\DTO\Output\User\UserOutputDTO;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $passwordHasher,
        private JWTTokenManagerInterface $jWTTokenManager
    )
    {  
    }

    /**
     * @param array<string, string> $data
     */
    public function makeStoreUserInputDTO(array $data): StoreUserInputDTO
    {
        $userDTO = new StoreUserInputDTO();

        $userDTO->email = $data['email'];
        $userDTO->password = $data['password'];

        return $userDTO;
    }

    public function makeUser(StoreUserInputDTO $userDTO): User
    {
        $user = new User();

        $user->setEmail($userDTO->email);
        $user->setPassword($this->passwordHasher->hashPassword($user, $userDTO->password));

        return $user;
    }

    public function makeUserRegisterOutputDTO(User $user) : RegisterUserOutputDTO
    {
        $userDTO = new RegisterUserOutputDTO();

        $userDTO->id = $user->getId();
        $userDTO->email = $user->getEmail();
        $userDTO->token = $this->jWTTokenManager->create($user);

        return $userDTO;
    }

    public function makeUserOutputDTO(User $user): UserOutputDTO
    {
        $userDTO = new UserOutputDTO();

        $userDTO->id = $user->getId();
        $userDTO->email = $user->getEmail();

        return $userDTO;
    }
}