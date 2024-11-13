<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\DTO\AddTeacherDTO;
use App\Application\DTO\TeacherDTO;
use App\Application\DTO\UpdateTeacherDTO;
use App\Application\Helper\AppError;
use App\Domain\Entity\Teacher;
use App\Infrastructure\Repository\TeacherRepository;

readonly class TeacherService
{
    public function __construct(
        private TeacherRepository $teacherRepository,
        private UserService $userService,
    ) {
    }

    public function addTeacher(AddTeacherDTO $command): ?AppError
    {
        $result = $this->userService->addUser($command->login, $command->password);
        if ($result instanceof AppError) {
            return AppError::setMessage('Ошибка создания педагога. '.$result->getMessage());
        }
        $user = $result;

        $teacher = new Teacher($user);
        $teacher->setFirstName($command->firstName);
        $teacher->setLastName($command->lastName);
        $teacher->setMiddleName($command->middleName);

        $this->teacherRepository->save($teacher);

        return null;
    }

    public function getTeacherList(): array
    {
        $teachers = $this->teacherRepository->findBy([], orderBy: ['lastName' => 'ASC']);
        $teacherDTOs = [];
        foreach ($teachers as $teacher) {
            $teacherDTOs[] = new TeacherDTO(
                login: $teacher->getUser()->getLogin(),
                id: $teacher->getId(),
                firstName: $teacher->getFirstName(),
                lastName: $teacher->getLastName(),
                middleName: $teacher->getMiddleName()
            );
        }

        return $teacherDTOs;
    }

    public function getTeacher(int $id): TeacherDTO
    {
        $teacher = $this->teacherRepository->find($id);

        return new TeacherDTO(
            login: $teacher->getUser()->getLogin(),
            id: $teacher->getId(),
            firstName: $teacher->getFirstName(),
            lastName: $teacher->getLastName(),
            middleName: $teacher->getMiddleName()
        );
    }

    public function updateTeacher(UpdateTeacherDTO $updateTeacherDTO): ?AppError
    {
        if (!$teacher = $this->teacherRepository->find($updateTeacherDTO->id)) {
            return AppError::setMessage("Не найден пользователь с id {$updateTeacherDTO->id}");
        }

        $teacher->setFirstName($updateTeacherDTO->firstName);
        $teacher->setLastName($updateTeacherDTO->lastName);
        $teacher->setMiddleName($updateTeacherDTO->middleName);

        $this->teacherRepository->save($teacher);

        return null;
    }
}
