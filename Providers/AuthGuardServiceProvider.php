<?php

namespace Elightwalk\AuthGuard\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class AuthGuardServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('AuthGuard', 'Database/Migrations'));
        $this->registerMiddleware();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(ViewServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {

        $this->publishes([
            module_path('AuthGuard', 'Config/config.php') => config_path('authguard.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('AuthGuard', 'Config/config.php'), 'authguard'
        );

        $this->mergeConfigFrom(
            module_path('AuthGuard', 'Config/guard.php'), 'auth.guards'
        );

        $this->mergeConfigFrom(
            module_path('AuthGuard', 'Config/provider.php'), 'auth.providers'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/authguard');

        $sourcePath = module_path('AuthGuard', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/authguard';
        }, \Config::get('view.paths')), [$sourcePath]), 'authguard');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/authguard');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'authguard');
        } else {
            $this->loadTranslationsFrom(module_path('AuthGuard', 'Resources/lang'), 'authguard');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('AuthGuard', 'Database/factories'));
        }
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

    public function registerMiddleware()
    {
        app()->make('router')->aliasMiddleware('authguardguest', \Elightwalk\AuthGuard\Http\Middleware\RedirectIfAuthenticated::class);
        app()->make('router')->aliasMiddleware('admin', \Elightwalk\AuthGuard\Http\Middleware\Admin::class);
        app()->make('router')->aliasMiddleware('customer', \Elightwalk\AuthGuard\Http\Middleware\Customer::class);
    }
}
