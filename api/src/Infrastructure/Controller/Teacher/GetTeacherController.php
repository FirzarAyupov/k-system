<?php

namespace App\Infrastructure\Controller\Teacher;

use App\Application\Service\TeacherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class GetTeacherController extends AbstractController
{
    public function __construct(
        private readonly TeacherService $teacherService,
    ) {
    }

    #[Route('/api/v1/teachers/{id}', name: 'get_teacher', methods: ['GET'])]
    public function __invoke(int $id): JsonResponse
    {
        $teacher = $this->teacherService->getTeacher($id);

        return $this->json($teacher);
    }
}
