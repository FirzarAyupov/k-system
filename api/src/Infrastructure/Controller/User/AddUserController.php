<?php

namespace App\Infrastructure\Controller\User;

use App\Infrastructure\Controller\User\DTO\AddUserDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class AddUserController extends AbstractController
{
    #[Route('/api/v1/users', name: 'app_user_add', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload]
        AddUserDTO $addUserDTO
    ): JsonResponse
    {
        return $this->json([
            'login' => $addUserDTO->login,
            'password' => $addUserDTO->password
        ]);
    }
}
