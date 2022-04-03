<?php

declare(strict_types=1);

namespace WordleEngine;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class DictionaryTest extends TestCase
{
    public function testAnEmptyDictionaryHasNoWords(): void
    {
        $dictionary = new Dictionary([]);

        $this->assertEquals(0, $dictionary->wordCount());
    }

    public function testADictionaryWithOnlyOneWordInsideReturnsTheCorrectCount(): void
    {
        $words = [new Word('happy')];
        $dictionary = new Dictionary($words);

        $this->assertEquals(1, $dictionary->wordCount());
    }

    public function testIfAwordExistsInADictionaryWhenItDoesNotIncludeTheGivenWordShouldReturnFalse(): void
    {
        $words = [new Word('happy')];
        $dictionary = new Dictionary($words);

        $this->assertFalse($dictionary->includesWord(new Word('sadly')));
    }

    public function testIfAwordExistsInADictionaryWhenItDoesIncludeTheGivenWordShouldReturnTrue(): void
    {
        $words = [new Word('happy')];
        $dictionary = new Dictionary($words);

        $this->assertTrue($dictionary->includesWord(new Word('happy')));
    }
}
