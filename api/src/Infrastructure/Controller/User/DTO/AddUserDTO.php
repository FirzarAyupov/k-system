<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\User\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class AddUserDTO
{

    public function __construct(
        #[Assert\NotBlank]
        public string $login,
        #[Assert\NotBlank]
        #[Assert\Length(min: 6)]
        public string $password
    ) {
    }

}