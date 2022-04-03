<?php

declare(strict_types=1);

namespace WordleEngine;

use function Safe\mb_str_split;
use function Safe\preg_match_all;
use WordleEngine\Exceptions\InvalidLettersException;
use WordleEngine\Exceptions\WordTooLongException;
use WordleEngine\Exceptions\WordTooShortException;

final class Word
{
    private string $word;

    public function __construct(string $word)
    {
        $word_length = mb_strlen($word);

        if ($word_length > 5) {
            throw new WordTooLongException($word);
        }

        if ($word_length < 5) {
            throw new WordTooShortException($word);
        }

        if (preg_match_all('/^[A-Za-z]{5}$/i', $word) !== 1) {
            throw new InvalidLettersException($word);
        }

        $this->word = $word;
    }

    public function __toString(): string
    {
        return $this->word;
    }

    /**
     * @return string[]
     */
    public function letters(): array
    {
        return mb_str_split($this->word);
    }

    /**
     * @return int[]
     */
    public function positionMatches(Word $other): array
    {
        $other_letters = $other->letters();

        return array_reduce($this->letters(), static function ($accumulator, $current) use ($other_letters) {
            $index = array_search($current, $other_letters, true);

            if ($index === false || is_string($index)) {
                return $accumulator;
            }

            return [...$accumulator, $index];
        }, []);
    }

    public function isSameAs(Word $word): bool
    {
        return $this->word === strval($word);
    }
}
