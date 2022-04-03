<?php

declare(strict_types=1);

namespace WordleEngine;

use WordleEngine\Exceptions\InvalidDictionaryEntryException;

final class Game
{
    /**
     * @var Word[]
     */
    private array $tries = [];
    private Dictionary $dictionary;
    private Word $gameWord;

    public function __construct(Dictionary $dictionary, Word $gameWord)
    {
        if (!$dictionary->includesWord($gameWord)) {
            throw new InvalidDictionaryEntryException($gameWord);
        }

        $this->dictionary = $dictionary;
        $this->gameWord = $gameWord;
    }

    public function try(Word $word): void
    {
        if (!$this->dictionary->includesWord($word)) {
            throw new InvalidDictionaryEntryException($word);
        }

        $this->tries[] = $word;
    }

    /**
     * @return Word[]
     */
    public function wordsTried(): array
    {
        return $this->tries;
    }

    public function hasWon(): bool
    {
        foreach ($this->tries as $try) {
            if ($try->isSameAs($this->gameWord)) {
                return true;
            }
        }

        return false;
    }

    public function hasLost(): bool
    {
        return count($this->tries) > 4;
    }
}
