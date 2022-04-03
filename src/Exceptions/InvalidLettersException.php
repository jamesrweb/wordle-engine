<?php

declare(strict_types=1);

namespace WordleEngine\Exceptions;

use Exception;

final class InvalidLettersException extends Exception
{
    public function __construct(string $word)
    {
        $message = "The given word '{$word}' contains invalid letters, words should only consist of the letters A to Z.";

        parent::__construct($message);
    }
}
