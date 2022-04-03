<?php

declare(strict_types=1);

namespace WordleEngine;

final class Dictionary
{
    /**
     * @var Word[]
     */
    private array $words;

    /**
     * @param Word[] $words
     */
    public function __construct(array $words)
    {
        $this->words = $words;
    }

    public function wordCount(): int
    {
        return count($this->words);
    }

    public function includesWord(Word $search): bool
    {
        foreach ($this->words as $word) {
            if ($word->isSameAs($search)) {
                return true;
            }
        }

        return false;
    }
}
