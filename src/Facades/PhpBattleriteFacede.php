<?php

namespace guastallaigor\PhpBattlerite\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class PhpBattlerite
 *
 * @author  Igor Guastalla de Lima  <limaguastallaigor@gmail.com>
 */
class PhpBattleriteFacede extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getPhpBattleriteFacede()
    {
        return 'phpbattlerite.main';
    }
}
