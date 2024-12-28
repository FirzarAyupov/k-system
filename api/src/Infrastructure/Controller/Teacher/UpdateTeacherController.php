<?php

namespace App\Infrastructure\Controller\Teacher;

use App\Application\DTO\UpdateTeacherDTO;
use App\Application\Helper\AppError;
use App\Application\Service\TeacherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class UpdateTeacherController extends AbstractController
{
    public function __construct(
        private readonly TeacherService $teacherService,
    ) {
    }

    #[Route('/api/v1/teacher', name: 'app_teacher_update', methods: ['PUT'])]
    public function __invoke(
        #[MapRequestPayload]
        UpdateTeacherDTO $updateTeacherDTO,
    ): Response {
        $result = $this->teacherService->updateTeacher($updateTeacherDTO);

        if ($result instanceof AppError) {
            return $this->json(
                ['error' => $result->getMessage()],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return new Response(status: Response::HTTP_OK);
    }
}
