<?php

declare(strict_types=1);

namespace App\Application\DTO;

class UpdateTeacherDTO
{
    public function __construct(
        public string $id,
        public string $firstName,
        public string $lastName,
        public ?string $middleName,
    ) {
    }
}
