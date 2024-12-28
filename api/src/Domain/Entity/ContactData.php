<?php

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class ContactData
{
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $address = null;

    public function __construct(
        ?string $email,
        ?string $address,
    ) {
        $this->email = $email;
        $this->address = $address;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }
}
