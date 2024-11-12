<?php

declare(strict_types=1);

namespace App\Application\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class AddTeacherDTO
{
    public function __construct(
        #[Assert\NotBlank]
        public string  $login,
        #[Assert\Length(min: 6, minMessage: "Пароль должен содержать не менее 6 символов")]
        public string  $password,
        #[Assert\NotBlank]
        public string  $firstName,
        #[Assert\NotBlank]
        public string  $lastName,
        public ?string $middleName
    )
    {
    }
}