<?php

declare(strict_types=1);

namespace WordleEngine;

use PHPUnit\Framework\TestCase;
use WordleEngine\Exceptions\InvalidDictionaryEntryException;

/**
 * @internal
 *
 * @small
 */
final class GameTest extends TestCase
{
    public function testANewGameHasNoWinner(): void
    {
        $words = [new Word('valid')];
        $dictionary = new Dictionary($words);
        $game = new Game($dictionary, new Word('valid'));

        $this->assertFalse($game->hasWon());
    }

    public function testANewGameHasNoTriesAssociatedWithIt(): void
    {
        $words = [new Word('valid')];
        $dictionary = new Dictionary($words);
        $game = new Game($dictionary, new Word('valid'));

        $this->assertEquals([], $game->wordsTried());
    }

    public function testTryingAWordWillBeRecordedCorrectly(): void
    {
        $words = [new Word('valid')];
        $dictionary = new Dictionary($words);
        $game = new Game($dictionary, new Word('valid'));

        $game->try(new Word('valid'));

        $this->assertEquals([new Word('valid')], $game->wordsTried());
    }

    public function testWhenLessThanFiveTriesAreAttemptedALossIsNotRecorded(): void
    {
        $words = [new Word('valid')];
        $dictionary = new Dictionary($words);
        $game = new Game($dictionary, new Word('valid'));

        $game->try(new Word('valid'));
        $game->try(new Word('valid'));
        $game->try(new Word('valid'));
        $game->try(new Word('valid'));

        $this->assertFalse($game->hasLost());
    }

    public function testWhenFiveOrMoreTriesAreAttemptedALossIsRecorded(): void
    {
        $words = [new Word('valid')];
        $dictionary = new Dictionary($words);
        $game = new Game($dictionary, new Word('valid'));

        $game->try(new Word('valid'));
        $game->try(new Word('valid'));
        $game->try(new Word('valid'));
        $game->try(new Word('valid'));
        $game->try(new Word('valid'));

        $this->assertTrue($game->hasLost());
    }

    public function testPlayingAnInvalidWordShouldRaiseAnException(): void
    {
        $words = [new Word('valid')];
        $dictionary = new Dictionary($words);
        $game = new Game($dictionary, new Word('valid'));

        $this->expectException(InvalidDictionaryEntryException::class);
        $game->try(new Word('xxxxx'));
    }

    public function testPlayingTheCorrectWordShouldCauseTheGameToBeWon(): void
    {
        $words = [new Word('valid')];
        $dictionary = new Dictionary($words);
        $game = new Game($dictionary, new Word('valid'));

        $this->assertFalse($game->hasWon());
        $game->try(new Word('valid'));
        $this->assertTrue($game->hasWon());
    }

    public function testCreatingAGameWithAGameWordThatDoesNotExistInTheDictionaryShouldRaiseAnException(): void
    {
        $this->expectException(InvalidDictionaryEntryException::class);

        $words = [new Word('valid')];
        $dictionary = new Dictionary($words);

        new Game($dictionary, new Word('xxxxx'));
    }
}
