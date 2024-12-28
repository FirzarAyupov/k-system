<?php

declare(strict_types=1);

namespace App\Application\Helper;

readonly class AppError
{
    private function __construct(
        private string $message,
    ) {
    }

    public static function setMessage(string $message): self
    {
        return new self($message);
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
