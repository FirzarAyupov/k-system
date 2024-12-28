<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

enum QualificationCategory: string
{
    case HIGHEST = 'highest';
    case FIRST = 'first';
    case UNCATEGORIZED = 'uncategorized';

    public function getName(): string
    {
        return match ($this) {
            self::HIGHEST => 'Высшая',
            self::FIRST => 'Первая',
            self::UNCATEGORIZED => 'Без категории',
            default => '',
        };
    }
}
