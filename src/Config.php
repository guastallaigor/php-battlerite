<?php

namespace guastallaigor\PhpBattlerite;

use guastallaigor\PhpBattlerite\Exceptions\ConfigFileNotFoundException;
use Illuminate\Config\Repository;

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
class Config
{
    /**
     * Config file name.
     */
    private static $configFileName = 'phpbattlerite';

    /**
     * @var \Illuminate\Config\Repository
     */
    private $config;

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $configPath = $this->configurationPath();

        $config_file = $configPath.'/'.self::$configFileName.'.php';

        if (!file_exists($config_file)) {
            throw new ConfigFileNotFoundException();
        }

        $this->config = new Repository(require $config_file);
    }

    /**
     * return the correct config directory path.
     *
     * @return mixed|string
     */
    private function configurationPath()
    {
        // the config file of the package directory
        $config_path = __DIR__.'/Config';

        // check if this laravel specific function `config_path()` exist (means this package is used inside
        // a laravel framework). If so then load then try to load the laravel config file if it exist.
        if (function_exists('config_path')) {
            $config_path = config_path();
        }

        return $config_path;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->config->get($key);
    }
}
