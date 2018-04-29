<?php

namespace PhpBattlerite\PhpBattlerite\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class PhpBattlerite
 *
 * @author  Igor Guastalla de Lima  <limaguastallaigor@gmail.com>
 */
class PhpBattlerite extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getPhpBattlerite()
    {
        return 'phpbattlerite.sample';
    }
}
