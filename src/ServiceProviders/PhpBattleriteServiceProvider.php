<?php

namespace guastallaigor\PhpBattlerite\ServiceProviders;

use guastallaigor\PhpBattlerite\Facades\PhpBattlerite;
use guastallaigor\PhpBattlerite\Main;
use Illuminate\Support\ServiceProvider;

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
class PhpBattleriteServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Publish the Config file from the Package to the App directory.
     *
     * @return void
     */
    public function boot()
    {
        $this->configPublisher();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        /*
        * Implementation Bindings.
        */
        $this->implementationBindings();

        /*
        * Facade Bindings.
        */
        $this->facadeBindings();
    }

    /**
     * Binding app to Main class.
     *
     * @return void
     */
    private function implementationBindings()
    {
        $this->app->bind(
            Main::class
        );
    }

    /**
     * Publish the Config file from the Package to the App directory.
     *
     * @return void
     */
    private function configPublisher()
    {
        // When users execute Laravel's vendor:publish command, the config file will be copied to the specified location
        $this->publishes(
            [
                __DIR__.'/Config/phpbattlerite.php' => config_path('phpbattlerite.php'),
            ]
        );
    }

    /**
     * Binding app to the Facede.
     *
     * @return void
     */
    private function facadeBindings()
    {
        // Register 'PhpBattlerite' Alias,
        // So users don't have to add the Alias to the 'app/config/app.php'
        $this->app->booting(
            function () {
                $loader = \Illuminate\Foundation\AliasLoader::getInstance();
                $loader->alias('PhpBattlerite', PhpBattleriteFacede::class);
            }
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
