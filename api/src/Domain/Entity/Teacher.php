<?php

namespace App\Domain\Entity;

use App\Infrastructure\Repository\TeacherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, TeacherDetail>
     */
    #[ORM\OneToMany(targetEntity: TeacherDetail::class, mappedBy: 'teacher', orphanRemoval: true)]
    private Collection $teacherDetails;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->teacherDetails = new ArrayCollection();
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

    /**
     * @return Collection<int, TeacherDetail>
     */
    public function getTeacherDetails(): Collection
    {
        return $this->teacherDetails;
    }

    public function addTeacherDetail(TeacherDetail $teacherDetail): static
    {
        if (!$this->teacherDetails->contains($teacherDetail)) {
            $this->teacherDetails->add($teacherDetail);
            $teacherDetail->setTeacher($this);
        }

        return $this;
    }

    public function removeTeacherDetail(TeacherDetail $teacherDetail): static
    {
        if ($this->teacherDetails->removeElement($teacherDetail)) {
            // set the owning side to null (unless already changed)
            if ($teacherDetail->getTeacher() === $this) {
                $teacherDetail->setTeacher(null);
            }
        }

        return $this;
    }
}
