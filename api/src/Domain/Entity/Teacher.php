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

    #[ORM\Column(length: 255, nullable: false)]
    private string $firstName;

    #[ORM\Column(length: 255, nullable: false)]
    private string $lastName;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $middleName = null;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firsName): static
    {
        $this->firstName = $firsName;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setMiddleName(?string $middleName): void
    {
        $this->middleName = $middleName;
    }

    public function getMiddleName(): string
    {
        return $this->middleName;
    }
}
