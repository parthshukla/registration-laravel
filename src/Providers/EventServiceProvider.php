<?php
namespace ParthShukla\Registration\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use ParthShukla\Registration\Events\UserRegistered;
use ParthShukla\Registration\Listeners\SendWelcomeMail;

/**
 * EventServiceProvider class
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author Parth Shukla <shuklaparth@hotmail.com>
 */
class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        UserRegistered::class => [
            SendWelcomeMail::class,
        ]
    ];

    public function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
    }

}
// end of class EventServiceProvider
// end of file EventServiceProvider.php
