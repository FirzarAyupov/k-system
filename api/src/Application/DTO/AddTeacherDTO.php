<?php

declare(strict_types=1);

namespace App\Application\DTO;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class AddTeacherDTO
{
    public function __construct(
        #[Groups('teacher_add')]
        #[Assert\NotBlank]
        public string $login,
        #[Groups('teacher_add')]
        #[Assert\Length(min: 6, minMessage: 'Пароль должен содержать не менее 6 символов')]
        public string  $password,
        #[Assert\NotBlank]
        #[Groups('teacher_add')]
        public string  $firstName,
        #[Groups('teacher_add')]
        #[Assert\NotBlank]
        public string  $lastName,
        #[Groups('teacher_add')]
        public ?string $middleName,
        public ?string $address,
        public ?string $birthdate,
    ) {
    }
}
