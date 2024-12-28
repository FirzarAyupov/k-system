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
    private ?string $patronymic = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $birthDate = null;

    public function __construct(
        string $firstName,
        string $lastName,
        ?string $patronymic = null,
        ?\DateTimeImmutable $birthDate = null,
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->patronymic = $patronymic;
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

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function getBirthDate(): ?\DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function getFullName(): string
    {
        $fullName = $this->firstName.' '.$this->lastName;

        if ($this->patronymic) {
            $fullName .= ' '.$this->patronymic;
        }

        return $fullName;
    }
}
