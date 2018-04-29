<?php

namespace PhpBattlerite\PhpBattlerite;

/**
 * Class Sample
 *
 * @author  Igor Guastalla de Lima  <limaguastallaigor@gmail.com>
 */
class Sample
{

    /**
     * @var  \PhpBattlerite\PhpBattlerite\Config
     */
    private $config;

    /**
     * Sample constructor.
     *
     * @param \PhpBattlerite\PhpBattlerite\Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param $name
     *
     * @return  string
     */
    public function sayHello($name)
    {
        $greeting = $this->config->get('greeting');

        return $greeting . ' ' . $name;
    }

}
