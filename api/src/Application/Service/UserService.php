<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Helper\AppError;
use App\Domain\Entity\User;
use App\Infrastructure\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class UserService
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private UserRepository $userRepository,
    ) {
    }

    public function addUser(string $login, string $plainPassword): AppError|User
    {
        if ($this->userRepository->findOneBy(['login' => $login])) {
            return AppError::setMessage('Пользователь с таким логином уже существует');
        }
        $user = new User();
        $user->setLogin($login);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plainPassword
        );
        $user->setPassword($hashedPassword);

        $this->userRepository->save($user);

        return $user;
    }

    public function deleteUser(string $id): void
    {
        if (!$user = $this->userRepository->find($id)) {
            return;
        }

        $this->userRepository->remove($user);
    }
}
