<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\YearsValue;
use App\Domain\ValueObject\QualificationCategory;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class ExtraData
{
    #[ORM\Column(nullable: true)]
    private ?YearsValue $experienceYears = null;

    #[ORM\Column(nullable: true)]
    private ?QualificationCategory $qualificationCategory = null;

    #[ORM\Column(nullable: true)]
    private ?int $lastAttestationYear = null;

    #[ORM\Column(nullable: true)]
    private ?int $nextAttestationYear = null;

    public function __construct(
        int $experienceYears,
        QualificationCategory $qualificationCategory,
        ?int $lastAttestationYear = null,
        ?int $nextAttestationYear = null,
    ) {
        $this->experienceYears = new YearsValue($experienceYears);
        $this->qualificationCategory = $qualificationCategory;

        if ($lastAttestationYear) {
            $this->setLastAttestationYear($lastAttestationYear);
        }
        if ($nextAttestationYear) {
            $this->setNextAttestationYear($nextAttestationYear);
        }
    }

    public function getExperienceYears(): ?int
    {
        return $this->experienceYears->getYears();
    }

    public function getQualificationCategory(): ?string
    {
        return $this->qualificationCategory->getName();
    }

    public function getLastAttestationYear(): ?int
    {
        return $this->lastAttestationYear;
    }

    public function getNextAttestationYear(): ?int
    {
        return $this->nextAttestationYear;
    }

    private function setLastAttestationYear(int $lastAttestationYear): void
    {
        $this->lastAttestationYear = $lastAttestationYear;
        $this->setNextAttestationYear($lastAttestationYear + 5);
    }

    private function setNextAttestationYear(int $nextAttestationYear): void
    {
        if ($nextAttestationYear < $this->lastAttestationYear) {
            throw new \InvalidArgumentException('Next attestation year must be greater than last attestation year');
        }

        $this->nextAttestationYear = $nextAttestationYear;
    }
}
