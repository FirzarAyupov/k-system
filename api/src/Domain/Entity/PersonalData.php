<?php

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class PersonalData
{
    #[ORM\Column(length: 255, nullable: false)]
    private string $firstName;

    #[ORM\Column(length: 255, nullable: false)]
    private string $lastName;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $middleName = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $birthDate = null;

    public function __construct(
        string $firstName,
        string $lastName,
        ?string $middleName = null,
        ?\DateTimeImmutable $birthDate = null,
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->middleName = $middleName;
        $this->birthDate = $birthDate;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function getBirthDate(): ?\DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function getFullName(): string
    {
        $fullName = $this->firstName.' '.$this->lastName;

        if ($this->middleName) {
            $fullName .= ' '.$this->middleName;
        }

        return $fullName;
    }
}
