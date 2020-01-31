Laravel 5 Modules
===============

- [Installation](#installation)
- [Configuration](#configuration)
- [Creating Module](#creating-a-module)
- [Naming Convension](#naming-convension)
- [Folder Structure](#folder-structure)
- [Helpers](#helpers)
- [Compiling Assets](#compiling-assets)
- [Artisan Commands](#artisan-commands)
- [Facades](#facade-methods)
- [Module Methods](#module-methods)
- [Module Resources](#module-resources)
- [Module Console Commands](#module-console-commands)
- [Event Service Provider](#event-service-provider)
- [Credits](#credits)
- [About us](#about)
- [License](#license)

`elightwalk/laravel-modules` is a Laravel package which created to manage your large Laravel app using modules. Module is like a Laravel package, it has some views, controllers or models. This package is supported and tested in Laravel 6.

<a name="installation"></a>
## Install

To install through Composer, by run the following command:

``` bash
composer require elightwalk/laravel-modules
```

The package will automatically register a service provider and alias.

publish the package's configuration file by running:

``` bash
php artisan vendor:publish --provider="Elightwalk\Modules\LaravelModulesServiceProvider"
```

### Autoloading

By default the module classes are not loaded automatically. You can autoload your modules using `psr-4`. For example:

``` json
{
  "autoload": {
    "psr-4": {
      "App\\": "app/",
      "Elightwalk\\": "app/Modules/Elightwalk/"
    }
  }
}
```

### Composer

Do composer autoload

``` bash
composer dump-autoload
```

### Config cache

Clear config cache 

``` bash
php artisan config:cache
```


<a name="configuration"></a>

## Configuration

- `namespace` - What the default namespace will be when generating modules.
- `stubs` - Overwrite the default generated stubs to be used when generating modules. This can be useful to customise the output of different files.
- `paths` - Overwrite the default paths used throughout the package.
- `scan` - This is disabled by default. Once enabled, the package will look for modules in the specified array of paths.
- `composer` - Customise the generated composer.json file.
- `cache` - If you have many modules it's a good idea to cache this information (like the multiple module.json files for example).
- `register` - Decide which custom namespaces need to be registered by the package. If one is set to false, the package won't handle its registration.
- `activators` - Show module status
- `activator` - Select from activators



  <a name="creating-a-module"></a>
## Creating A Module

To create a new module you can simply run :

```
php artisan module:make <module-name>
```

- `<module-name>` - Required. The name of module will be created.


**Create multiple modules**

```
php artisan module:make User Auth
```

By default if you create a new module, that will add some resources like controller, seed class or provider automatically. If you don't want these, you can add `--plain` flag, to generate a plain module.

```shell
php artisan module:make User --plain
#OR
php artisan module:make User -p
```

<a name="naming-convension"></a>

**Naming Convension**

Because we are autoloading the modules using `psr-4`, we strongly recommend using `StudlyCase` convension.


<a name="folder-structure"></a>

**Folder Structure**

```
laravel-app/
app/
  Modules/
    ├── Elightwalk/
      ├── User/
          ├── Config/
          ├── Console/
          ├── Database/
              ├── factories/
              ├── Migrations/
              ├── Seeders/
                  ├── UserDatabaseSeeder.php
          ├── Entities/
          ├── Http/
              ├── Controllers/
                  ├── UserController.php
              ├── Middleware/
              ├── Requests/
          ├── Providers/
              ├── RouterServiceProvider.php
              ├── UserServiceProvider.php
          ├── Resources/
              ├── assets/
                  ├── js/
                      ├── app.js
                  ├── sass/
                      ├── app.sass
              ├── lang/
              ├── views/
                  ├── layouts/
                      ├── master.blade.php
                  ├── index.blade.php
          ├── Routes/
              ├── api.php
              ├── web.php
          ├── Tests/
              ├── Feature/
              ├── Unit/
          ├── composer.json
          ├── module.json
          ├── package.json
          ├── webpack.mix.js
bootstrap/
vendor/
```
<a name="helpers"></a>

## Helpers

Get the path to the given module.

```
$path = module_path('User');
```
<a name="compiling-assets"></a>

## Compiling Assets (Laravel Mix) Installation & Setup

The default package.json file includes everything you need to get started. You may install the dependencies it references by running:

```
npm install
```

## Running Mix
Mix is a configuration layer on top of Webpack, so to run your Mix tasks you only need to execute one of the NPM scripts that is included with the default laravel-modules package.json file

```
// Run all Mix tasks...
npm run dev

// Run all Mix tasks and minify output...
npm run production
```

After generating the versioned file, you won't know the exact file name. So, you should use Laravel's global mix function within your views to load the appropriately hashed asset. The mix function will automatically determine the current name of the hashed file:

```
// Modules/Elightwalk/User/Resources/views/layouts/master.blade.php

<link rel="stylesheet" href="{{ mix('css/user.css') }}">

<script src="{{ mix('js/user.js') }}"></script>
```

For more info on Laravel Mix view the documentation here: https://laravel.com/docs/mix

## Install laravel-mix-merge-manifest

```
npm install laravel-mix-merge-manifest --save-dev
```

## Modify webpack.mix.js main file
```
let mix = require('laravel-mix');


/* Allow multiple Laravel Mix applications*/
require('laravel-mix-merge-manifest');
mix.mergeManifest();
/*----------------------------------------*/

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

```

<a name="artisan-commands"></a>

## Module manage

Create new module.
```
php artisan module:make User
```

Generate multiple module.
```
php artisan module:make User Auth
```

Use a given module. This allows you to not specify the module name on other commands requiring the module name as an argument.
```
php artisan module:use User
```

This unsets the specified module that was set with the module:use command.
```
php artisan module:unuse User
```

List all available modules.
```
php artisan module:list
```

Enable the given module.
```
php artisan module:enable User
```

Disable the given module.
```
php artisan module:disable User
```

Update the given module.
```
php artisan module:update User
```

## Migrate

Migrate the given module, or without a module an argument, migrate all modules.
```
php artisan module:migrate User
```

Rollback the given module, or without an argument, rollback all modules.
```
php artisan module:migrate-rollback User
```

Refresh the migration for the given module, or without a specified module refresh all modules migrations.
```
php artisan module:migrate-refresh User
```

Reset the migration for the given module, or without a specified module reset all modules migrations.
```
php artisan module:migrate-reset User
```

Generate a migration for specified module.
```
php artisan module:make-migration create_posts_table User
```

## Seed

Seed the given module, or without an argument, seed all modules
```
php artisan module:seed User
```

Generate the given seed name for the specified module.
```
php artisan module:make-seed seed_fake_blog_posts User
```

## Publish

Publish the migration files for the given module, or without an argument publish all modules migrations.
```
php artisan module:publish-migration
```

Publish the given module configuration files, or without an argument publish all modules configuration files.
```
php artisan module:publish-config User
```

Publish the translation files for the given module, or without a specified module publish all modules migrations.
```
php artisan module:publish-translation User
```

## Generator commands

Generate the given console command for the specified module.
```
php artisan module:make-command CreatePostCommand User
```

## Controller

Generate a controller for the specified module.
```
php artisan module:make-controller PostsController User
```

## Model

Generate the given model for the specified module.

Optional options:

  --fillable = field1,field2: set the fillable fields on the generated model
  --migration, -m: create the migration file for the given model
```
php artisan module:make-model Post User
```

## Provider

Generate the given service provider name for the specified module.
```
php artisan module:make-provider UserServiceProvider User
```

## Middleware

Generate the given middleware name for the specified module.
```
php artisan module:make-middleware CanReadPostsMiddleware User
```

## Mail

Generate the given mail class for the specified module.
```
php artisan module:make-mail SendWeeklyPostsEmail User
```

## Notification
Generate the given notification class name for the specified module.
```
php artisan module:make-notification NotifyAdminOfNewComment User
```

## Event
Generate the given event for the specified module.
```
php artisan module:make-event UserPostWasUpdated User
```

## Listener
Generate the given listener for the specified module. Optionally you can specify which event class it should listen to. It also accepts a --queued flag allowed queued event listeners.
```
php artisan module:make-listener NotifyUsersOfANewPost User
php artisan module:make-listener NotifyUsersOfANewPost User --event=PostWasCreated
php artisan module:make-listener NotifyUsersOfANewPost User --event=PostWasCreated --queued
```

## Request
Generate the given request for the specified module.
```
php artisan module:make-request CreatePostRequest User
```

## Job
Generate the given job for the specified module.
```
php artisan module:make-job JobName User

php artisan module:make-job JobName User --sync # A synchronous job class
```

## Route Provider
Generate the given route service provider for the specified module.
```
php artisan module:route-provider User
```

## Factory
Generate the given database factory for the specified module.
```
php artisan module:make-factory FactoryName User
```

## Policy
Generate the given policy class for the specified module.
The Policies is not generated by default when creating a new module. Change the value of paths.generator.policies in mconfig.php to your desired location.
```
php artisan module:make-policy PolicyName User
```

## Rule
Generate the given policy class for the specified module.
The Rules folder is not generated by default when creating a new module. Change the value of paths.generator.rules in mconfig.php to your desired location.
```
php artisan module:make-rule ValidationRule User
```


## Resources
Generate the given resource class for the specified module. It can have an optional --collection argument to generate a resource collection.
The Transformers folder is not generated by default when creating a new module. Change the value of paths.generator.resource in mconfig.php to your desired location.
```
php artisan module:make-resource PostResource User
php artisan module:make-resource PostResource User --collection
```

## Test
Generate the given test class for the specified module.
```
php artisan module:make-test EloquentPostRepositoryTest User
```
<a name="facade-methods"></a>

## Facade methods

Get all modules.
```
Module::all();
```

Get all cached modules.
```
Module::getCached()
```

Get ordered modules. The modules will be ordered by the priority key in config/modules.php file.
```
Module::getOrdered();
```

Get scanned modules.
```
Module::scan();
```

Find a specific module.
```
Module::find('name');

// OR

Module::get('name');
```

Find a module, if there is one, return the Module instance, otherwise throw Elightwalk\Modules\Exeptions\ModuleNotFoundException.
```
Module::findOrFail('module-name');
```

Get scanned paths.
```
Module::getScanPaths();
```

Get all modules as a collection instance.
```
Module::toCollection();
```

Get modules by the status. 1 for active and 0 for inactive.
```
Module::getByStatus(1);
```

Check the specified module. If it exists, will return true, otherwise false.
```
Module::has('module-name');
```

Get all enabled modules.
```
Module::allEnabled();
```

Get all disabled modules.
```
Module::allDisabled();
```

Get count of all modules.
```
Module::count();
```

Get module path.
```
Module::getPath();
```

Register the modules.
```
Module::register();
```

Boot all available modules.
```
Module::boot();
```

Get all enabled modules as collection instance.
```
Module::collections();
```

Get module path from the specified module.
```
Module::getModulePath('name');
```

Get assets path from the specified module.
```
Module::assetPath('name');
```

Get config value from this package.
```
Module::config('composer.vendor');
```

Get used storage path.
```
Module::getUsedStoragePath();
```

Get used module for cli session.
```
Module::getUsedNow();
// OR
Module::getUsed();
```

Set used module for cli session.
```
Module::setUsed('name');
```

Get modules's assets path.
```
Module::getAssetsPath();
```

Get asset url from specific module.
```
Module::asset('user:img/logo.img');
```

Install the specified module by given module name.
```
Module::install('elightwalk/hello');
```

Update dependencies for the specified module.
```
Module::update('hello');
```

Add a macro to the module repository.
```
Module::macro('hello', function() {
    echo "I'm a macro";
});
```

Call a macro from the module repository.
```
Module::hello();
```

Get all required modules of a module
```
Module::getRequirements('module name');
```

<a name="module-methods"></a>

## Module Methods

Get an entity from a specific module.
```
$module = Module::find('blog');
```

Get module name.
```
$module->getName();
```

Get module name in lowercase.
```
$module->getLowerName();
```

Get module name in studlycase.
```
$module->getStudlyName();
```

Get module path.
```
$module->getPath();
```

Get extra path.
```
$module->getExtraPath('Assets');
```

Disable the specified module.
```
$module->disable();
```

Enable the specified module.
```
$module->enable();
```

Delete the specified module.
```
$module->delete();
```

Get an array of module requirements. Note: these should be aliases of the module.
```
$module->getRequires();
```



<a name="module-resources"></a>

## Module Resources

Your module will most likely contain what laravel calls resources, those contain configuration, views, translation files, etc. In order for you module to correctly load and if wanted publish them you need to let laravel know about them as in any regular package. clean cache  after merge

Configuration
```
$this->publishes([
    __DIR__.'/../Config/config.php' => config_path('user.php'),
], 'config');
$this->mergeConfigFrom(
    __DIR__.'/../Config/config.php', 'user'
);
```

The main part here is the loadViewsFrom method call. If you don't want your views to be published to the laravel views folder, you can remove the call to the $this->publishes() call.

Views
```
$viewPath = base_path('resources/views/modules/user');

$sourcePath = __DIR__.'/../Resources/views';

$this->publishes([
    $sourcePath => $viewPath
]);

$this->loadViewsFrom(array_merge(array_map(function ($path) {
    return $path . '/modules/user';
}, \Config::get('view.paths')), [$sourcePath]), 'user');
```

Use
```
@extends('user::layouts.master')
@include('user::auth.tokenexpire')
```




Language files
```
$langPath = base_path('resources/lang/modules/user');

if (is_dir($langPath)) {
    $this->loadTranslationsFrom($langPath, 'user');
} else {
    $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'user');
}
```

Structure

```
— Elightwalk
    - User
        — Resources
            — lang
                — en
                    messages.php
                — dk
                    messages.php
```

Use
```
@lang('user::messages.something')
```

Factories

If you want to use laravel factories you will have to add the following in your service provider:
```
$this->app->singleton(Factory::class, function () {
    return Factory::construct(__DIR__ . '/Database/factories');
});
```

<a name="module-console-commands"></a>

## Create Command
Your module may contain console commands. You can generate these commands manually, or with the following helper:

```
php artisan module:make-command CreatePostCommand User
```

This will create a CreatePostCommand inside the Blog module. By default this will be app/Modules/Elightwalk/User/Console/CreatePostCommand.

Please refer to the <a href="https://laravel.com/docs/5.8/artisan">laravel documentation on artisan commands </a> to learn all about them.

## Registering the command
You can register the command with the laravel method called commands that is available inside a service provider class.

```
$this->commands([
    \app\Modules\Elightwalk\User\Console\CreatePostCommand::class,
]);
```
You can now access your command via php artisan in the console.

<a name="event-service-provider"></a>

## Event Service Provider

Once you have multiple events, you might find it easier to have all events and their listeners in a dedicated service provider. This is what the EventServiceProvider is for.

Create a new class called for instance EventServiceProvider in the app/Modules/Elightwalk/User/Providers folder (Blog being an example name).

This class needs to look like this:

```
<?php

namespace Modules\Blog\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [];
}
```

This is now like the regular EventServiceProvider in the app/ namespace. In our example the listen property will look like this:
```
// ...
class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        BlogPostWasUpdated::class => [
            NotifyAdminOfNewPost::class,
        ],
    ];
}
```

<a name="credits"></a>

## Credits

- [ Elightwalk Technology ](https://github.com/elightwalk)

<a name="about"></a>

## About Elightwalk Technology

Elightwalk is leading in web development. We provide complete solutions that never compromise on functionality and design, Elightwalk leaders have great Experience over the web technologies, Our target to make customer and employees everyday happy.
Our Regular to do 
``` bash
Magento development.
Web app development.
WordPress development.
WooCommerce development.
Laravel development.
SaaS development.
PWA development.
Full Stack Development
```
visit [ elightwalk.com ](https://elightwalk.com).

<a name="license"></a>

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
