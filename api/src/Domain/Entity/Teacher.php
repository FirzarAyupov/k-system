<?php

namespace App\Domain\Entity;

use App\Infrastructure\Repository\TeacherRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeacherRepository::class)]
class Teacher
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne]
    private User $user;

    #[ORM\Embedded(class: PersonalData::class, columnPrefix: false)]
    private ?PersonalData $personalData = null;

    #[ORM\Embedded(class: ContactData::class, columnPrefix: false)]
    private ?ContactData $contactData = null;

    #[ORM\Embedded(class: ExtraData::class, columnPrefix: false)]
    private ?ExtraData $extraData = null;

    public function __construct(
        User $user,
        string $firstName,
        string $lastName,
        ?string $middleName,
    ) {
        $this->user = $user;
        $this->personalData = new PersonalData(
            firstName: $firstName,
            lastName: $lastName,
            middleName: $middleName
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getFirstName(): ?string
    {
        return $this->personalData?->getFirstName();
    }

    public function getLastName(): ?string
    {
        return $this->personalData?->getLastName();
    }

    public function getMiddleName(): ?string
    {
        return $this->personalData?->getMiddleName();
    }

    public function getFullName(): string
    {
        return $this->personalData?->getFullName();
    }

    public function updatePersonalData(
        ?string $firstName,
        ?string $lastName,
        ?string $middleName,
        ?\DateTimeImmutable $birthDate,
    ): self {
        $personalData = new PersonalData(
            firstName: $firstName ?? $this->personalData->getFirstName(),
            lastName: $lastName ?? $this->personalData->getLastName(),
            middleName: $middleName ?? $this->personalData->getMiddleName(),
            birthDate: $birthDate ?? $this->personalData->getBirthDate(),
        );
        $this->personalData = $personalData;

        return $this;
    }

    public function getContactData(): ContactData
    {
        return $this->contactData;
    }

    public function updateContactData(ContactData $contactData): self
    {
        $this->contactData = $contactData;

        return $this;
    }

    public function getExtraData(): ExtraData
    {
        return $this->extraData;
    }

    public function updateExtraData(ExtraData $extraData): self
    {
        $this->extraData = $extraData;

        return $this;
    }
}
