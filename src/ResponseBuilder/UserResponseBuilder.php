<?php 

namespace App\ResponseBuilder;

use App\Entity\User;
use App\Factory\UserFactory;
use App\Resource\UserResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserResponseBuilder
{

    public function __construct(
        private UserFactory $userFactory,
        private UserResource $userResource,
    )
    { 
    }

    public function storeUserResponse(
        User $user, 
        int $status = 201, 
        array $headers = [], 
        bool $isJson = true,
    ): JsonResponse
    {
        $userOutputDTO = $this->userFactory->makeUserOutputDTO($user);

        $userResource = $this->userResource->userItem($userOutputDTO);

        return new JsonResponse($userResource, $status, $headers, $isJson);
    }
}