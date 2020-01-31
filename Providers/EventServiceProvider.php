<?php

namespace Elightwalk\AuthGuard\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Elightwalk\AuthGuard\Events\ForgotPassword;
use Elightwalk\AuthGuard\Listeners\NotifyForgotPassword;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ForgotPassword::class => [
            NotifyForgotPassword::class,
        ],
    ];
}
