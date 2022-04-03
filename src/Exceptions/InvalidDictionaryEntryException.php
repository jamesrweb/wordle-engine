<?php

declare(strict_types=1);

namespace WordleEngine\Exceptions;

use Exception;
use WordleEngine\Word;

final class InvalidDictionaryEntryException extends Exception
{
    public function __construct(Word $word)
    {
        $message = "The given word '{$word}' does not exist within the current games dictionary.";

        parent::__construct($message);
    }
}
