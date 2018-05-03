<?php

namespace guastallaigor\PhpBattlerite\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use guastallaigor\PhpBattlerite\Facades\PhpBattlerite;
use guastallaigor\PhpBattlerite\Main;

 /**
  * PHP-Battlerite easy API
  *
  * @category  Games
  * @package   ServiceProviders
  * MainServiceProvider class for this package
  * @author    Igor Guastalla de Lima  <limaguastallaigor@gmail.com>
  * @copyright 2018 PHP Battlerite
  * @license   MIT https://github.com/guastallaigor/php-battlerite/blob/master/LICENSE
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
     * Boot the package.
     *
     * @return void
     */
    public function boot()
    {
        /*
        |--------------------------------------------------------------------------
        | Publish the Config file from the Package to the App directory
        |--------------------------------------------------------------------------
        */
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
        |--------------------------------------------------------------------------
        | Implementation Bindings
        |--------------------------------------------------------------------------
        */
        $this->implementationBindings();

        /*
        |--------------------------------------------------------------------------
        | Facade Bindings
        |--------------------------------------------------------------------------
        */
        $this->facadeBindings();

        /*
        |--------------------------------------------------------------------------
        | Registering Service Providers
        |--------------------------------------------------------------------------
        */
        $this->serviceProviders();
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
     * Publish the Config file from the Package to the App directory
     *
     * @return void
     */
    private function configPublisher()
    {
        // When users execute Laravel's vendor:publish command, the config file will be copied to the specified location
        $this->publishes(
            [
                __DIR__ . '/Config/phpbattlerite.php' =>
                    config_path('phpbattlerite.php')
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
        // Register 'phpbattlerite.say' instance container
        $this->app['phpbattlerite.phpbattlerite'] = $this->app->share(
            function ($app) {
                return $app->make(Main::class);
            }
        );

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

    /**
     * Registering Other Custom Service Providers (if you have)
     *
     * @return void
     */
    private function serviceProviders()
    {
        // $this->app->register('...\...\...');
    }
}
