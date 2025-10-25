<?php

namespace App\Controller;

use App\DTOValidator\DTOValidator;
use App\Factory\UserFactory;
use App\ResponseBuilder\UserResponseBuilder;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class AuthController extends AbstractController
{
    public function __construct(
        private UserFactory $userFactory,
        private DTOValidator $dTOValidator,
        private UserService $userService,
        private UserResponseBuilder $userResponseBuilder
    )
    {  
    }

    #[Route('/api/auth/register', name: 'auth_register', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), 'true');

        $userDTO = $this->userFactory->makeStoreUserInputDTO($data);

        $this->dTOValidator->validate($userDTO);

        $user = $this->userService->store($userDTO);

        return $this->userResponseBuilder->registerUserResponse($user);
    }

    #[Route('/api/auth/me', name: 'auth_me', methods: ['GET'])]
    public function me()
    {
        $user = $this->getUser();

        return $this->userResponseBuilder->meUserResponse($user);
    }
}
