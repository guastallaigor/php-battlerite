<?php

namespace guastallaigor\PhpBattlerite\Facades;

use Illuminate\Support\Facades\Facade;

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
