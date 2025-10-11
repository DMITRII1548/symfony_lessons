<?php

namespace App\Exception;

use RuntimeException;
use Throwable;

class ValidateException extends RuntimeException
{
    /**
     * @param array<string, string> $erros
     */
    public function __construct(
        private array $errors
    )
    {
        parent::__construct('Inlivalide arguments', 422);
    }

    /**
     * @return array<string, string>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}