<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\DTO\AddTeacherDTO;
use App\Application\DTO\TeacherDTO;
use App\Application\DTO\UpdateTeacherDTO;
use App\Application\Helper\AppError;
use App\Domain\Entity\Teacher;
use App\Domain\Entity\TeacherDetail;
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

        $teacher = new Teacher(
            user: $user,
            firstName: $command->firstName,
            lastName: $command->lastName,
            middleName: $command->middleName
        );

        $this->teacherRepository->save($teacher);

        return null;
    }

    public function getTeacherList(): array
    {
        $teachers = $this->teacherRepository->findBy([], orderBy: ['personalData.lastName' => 'ASC']);
        $teacherDTOs = [];
        /* @var Teacher $teacher */
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

        $details = $teacher->getPersonalData();

        return new TeacherDTO(
            login: $teacher->getUser()->getLogin(),
            id: $teacher->getId(),
            firstName: $teacher->getFirstName(),
            lastName: $teacher->getLastName(),
            middleName: $teacher->getMiddleName(),
            birthdate: $details->getBirthDate()->format('Y-m-d'),
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

        $detail = new TeacherDetail();
        $detail->setAddress($updateTeacherDTO->address);
        $date = \DateTimeImmutable::createFromFormat('Y-m-d', $updateTeacherDTO->birthdate);
        $detail->setBirthDate($date);

        $teacher->addTeacherDetail($detail);

        $this->teacherRepository->save($teacher);

        return null;
    }

    public function deleteTeacher(int $id): void
    {
        if (!$teacher = $this->teacherRepository->find($id)) {
            return;
        }
        $this->teacherRepository->remove($teacher);

        $this->userService->deleteUser($teacher->getUser()->getId()->toRfc4122());
    }
}
