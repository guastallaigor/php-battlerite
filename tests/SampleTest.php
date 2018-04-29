<?php

namespace PhpBattlerite\PhpBattlerite\Tests;

use PhpBattlerite\PhpBattlerite\Config;
use PhpBattlerite\PhpBattlerite\Sample;

/**
 * Class SampleTest
 *
 * @category Test
 * @package  PhpBattlerite\PhpBattlerite\Tests
 * @author   Igor Guastalla de Lima <limaguastallaigor@gmail.com>
 */
class SampleTest extends TestCase
{

    public function testSayHello()
    {
        $config = new Config();
        $sample = new Sample($config);

        $name = 'Igor Guastalla de Lima';

        $result = $sample->sayHello($name);

        $expected = $config->get('greeting') . ' ' . $name;

        $this->assertEquals($result, $expected);

    }

}
