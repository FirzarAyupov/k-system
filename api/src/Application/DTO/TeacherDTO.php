<?php

declare(strict_types=1);

namespace App\Application\DTO;

class TeacherDTO
{
    public function __construct(
        public int     $id,
        public string  $firstName,
        public string  $lastName,
        public ?string $middleName = null
    )
    {
    }

}