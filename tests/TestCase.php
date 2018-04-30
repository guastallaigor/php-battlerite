<?php

namespace guastallaigor\PhpBattlerite\Tests;

use Helmich\JsonAssert\JsonAssertions;
use PHPUnit\Framework\TestCase as PHPUnit;


/**
 * Class TestCase
 *
 * @author  Igor Guastalla de Lima  <limaguastallaigor@gmail.com>
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
