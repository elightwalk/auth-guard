<?php

namespace Elightwalk\AuthGuard\Providers;

use Illuminate\Support\ServiceProvider;
use Elightwalk\AuthGuard\Http\View\Composers\ForgotPasswordLayoutComposer;
use Elightwalk\AuthGuard\Http\View\Composers\ResetPasswordLayoutComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
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

    public function boot()
    {
        view()->composer(
            'authguard::auth.forgot', ForgotPasswordLayoutComposer::class
        );
    }
}
