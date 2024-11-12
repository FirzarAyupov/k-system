<?php

namespace App\Infrastructure\Controller\Teacher;

use App\Application\Service\TeacherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class GetTeachersController extends AbstractController
{
    public function __construct(
        private readonly TeacherService $teacherService,
    ) {
    }

    #[Route('/api/v1/teachers', name: 'get_teachers', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $teachers = $this->teacherService->getTeacherList();

        return $this->json($teachers);
    }
}
