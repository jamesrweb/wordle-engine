<?php

declare(strict_types=1);

namespace WordleEngine\Exceptions;

use Exception;

final class WordTooShortException extends Exception
{
    public function __construct(string $word)
    {
        $message = "The given word '{$word}' is too short, words should be 5 characters long.";

        parent::__construct($message);
    }
}
