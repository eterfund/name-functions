<?php

use PHPUnit\Framework\TestCase;
use function Names\{checkSplit, joinName};

final class FunctionsTest extends TestCase
{
    public function testCheckSplitValid ()
    {
        $this->assertEquals(
            true,
            checkSplit('Сидоров Иван Петрович', (object)[
                'name' => 'Иван',
                'surname' => 'Сидоров',
                'patronymic' => 'Петрович'
            ])
        );
    }

    public function testCheckSplitWordChanged ()
    {
        $this->assertEquals(
            false,
            checkSplit('Сидоров Иван Петрович', (object)[
                'name' => 'Иван',
                'surname' => 'Сидоров',
                'patronymic' => 'Петрович123'
            ])
        );
    }

    public function testCheckSplitWordRemoved ()
    {
        $this->assertEquals(
            false,
            checkSplit('Сидоров Иван Петрович', (object)[
                'name' => 'Иван',
                'surname' => 'Сидоров'
            ])
        );
    }

    public function testCheckSplitWordAdded ()
    {
        $this->assertEquals(
            false,
            checkSplit('Сидоров Иван', (object)[
                'name' => 'Иван',
                'surname' => 'Сидоров',
                'patronymic' => 'Петрович'
            ])
        );
    }

    public function testJoinName ()
    {
        $this->assertEquals(
            'Сидоров Иван Петрович',
            joinName((object)[
                'name' => 'Иван',
                'surname' => 'Сидоров',
                'patronymic' => 'Петрович'
            ])
        );
    }
}

