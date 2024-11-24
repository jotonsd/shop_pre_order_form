<?php

namespace Joton\PreOrder\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Joton\PreOrder\Events\PreOrderSubmitted;
use Joton\PreOrder\Listeners\SendAdminPreOrderEmail;
use Joton\PreOrder\Listeners\SendUserPreOrderEmail;

/**
 * Registers the events and listeners in the package.
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings.
     *
     * @var array
     */
    protected $listen = [
        PreOrderSubmitted::class => [
            SendUserPreOrderEmail::class,
            SendAdminPreOrderEmail::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
