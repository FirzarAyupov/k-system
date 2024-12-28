<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

readonly class YearsValue
{
    public function __construct(
        private int $years,
    ) {
        if ($years < 0) {
            throw new \InvalidArgumentException('Years must be greater than 0');
        }
    }

    public function getYears(): int
    {
        return $this->years;
    }
}
