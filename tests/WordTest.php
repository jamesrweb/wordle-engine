<?php

declare(strict_types=1);

namespace WordleEngine;

use PHPUnit\Framework\TestCase;
use WordleEngine\Exceptions\InvalidLettersException;
use WordleEngine\Exceptions\WordTooLongException;
use WordleEngine\Exceptions\WordTooShortException;

/**
 * @internal
 *
 * @small
 */
final class WordTest extends TestCase
{
    public function testValidInputWordsShouldProvideLetters(): void
    {
        $wordleWord = new Word('valid');

        $this->assertEquals(['v', 'a', 'l', 'i', 'd'], $wordleWord->letters());
    }

    public function testAnInputWordWithFewerThanFiveLettersShouldRaiseAnException(): void
    {
        $this->expectException(WordTooShortException::class);
        new Word('test');
    }

    public function testAnInputWordWithMoreThanFiveLettersShouldRaiseAnException(): void
    {
        $this->expectException(WordTooLongException::class);
        new Word('invalid');
    }

    public function testAnInputWordWithInvalidLettersShouldRaiseAnException(): void
    {
        $this->expectException(InvalidLettersException::class);
        new Word('Tästs');
    }

    public function testAnInputWordWithInvalidCharactersShouldRaiseAnException(): void
    {
        $this->expectException(InvalidLettersException::class);
        new Word('Cash$');
    }

    public function testTwoWordsAreNotTheSameIfTheWordTextDoesNotMatch(): void
    {
        $firstWord = new Word('valid');
        $secondWord = new Word('happy');

        $this->assertNotEquals($firstWord, $secondWord);
    }

    public function testTwoWordsAreTheSameIfTheWordTextMatches(): void
    {
        $firstWord = new Word('valid');
        $secondWord = new Word('valid');

        $this->assertEquals($firstWord, $secondWord);
    }

    public function testWordsWithoutLetterPositionOverlapHaveNoPositionMatches(): void
    {
        $firstWord = new Word('xxxxx');
        $secondWord = new Word('valid');

        $this->assertEquals([], $firstWord->positionMatches($secondWord));
    }

    public function testWordsWithLetterPositionOverlapHavePositionMatches(): void
    {
        $firstWord = new Word('venus');
        $secondWord = new Word('valid');

        $this->assertEquals([0], $firstWord->positionMatches($secondWord));
    }

    public function testTwoIdenticalWordMatchOnAllPositions(): void
    {
        $firstWord = new Word('valid');
        $secondWord = new Word('valid');

        $this->assertEquals([0, 1, 2, 3, 4], $firstWord->positionMatches($secondWord));
    }
}
