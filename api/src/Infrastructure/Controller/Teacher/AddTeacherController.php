<?php

namespace App\Infrastructure\Controller\Teacher;

use App\Application\DTO\AddTeacherDTO;
use App\Application\Helper\AppError;
use App\Application\Service\TeacherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class AddTeacherController extends AbstractController
{
    public function __construct(
        private readonly TeacherService $teacherService
    )
    {
    }

    #[Route('/api/v1/teacher', name: 'app_teacher_add', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload]
        AddTeacherDTO $addUserDTO
    ): Response
    {
        $result = $this->teacherService->addTeacher($addUserDTO);

        if ($result instanceof AppError) {
            return $this->json(
                ['error' => $result->getMessage()],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return new Response(status: Response::HTTP_CREATED);
    }
}
