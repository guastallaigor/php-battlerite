<?php

namespace guastallaigor\PhpBattlerite\Tests;

use Helmich\JsonAssert\JsonAssertions;
use PHPUnit\Framework\TestCase as PHPUnit;

/**
 * PHP-Battlerite easy API.
 *
 * @category  Games
 *
 * @author    Igor Guastalla de Lima  <limaguastallaigor@gmail.com>
 * @copyright 2018 PHP Battlerite
 * @license   MIT https://github.com/guastallaigor/php-battlerite/blob/master/LICENSE
 *
 * @link      https://github.com/guastallaigor/php-battlerite
 */
abstract class TestCase extends PHPUnit
{
    use JsonAssertions;

    public function __construct()
    {
        parent::__construct();
    }

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}
