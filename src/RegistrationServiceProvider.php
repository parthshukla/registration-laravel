<?php
namespace ParthShukla\Registration;

use Illuminate\Support\ServiceProvider;
use ParthShukla\Registration\Providers\EventServiceProvider;

/**
 * RegistrationServiceProvider class
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Parth Shukla <parthshukla@ahex.co.in>
 */
class RegistrationServiceProvider extends ServiceProvider
{

    /**
     * Boot method
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'ps-register');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ps-register');
    }

    //-------------------------------------------------------------------------

    /**
     * Register method
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(EventServiceProvider::class);
    }
}
// end of class RegistrationServiceProvider
// end of file RegistrationServiceProvider.php
