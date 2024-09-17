<?php

namespace Spd\User\Providers;

use Spd\User\Models\User;
use Spd\Role\Models\Permission;
use Spd\User\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(EventServiceProvider::class);
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'User');

        Route::middleware('web')->namespace('Spd\User\Http\Controllers')->group(__DIR__ . '/../Routes/user_routes.php');

        Gate::policy(User::class, UserPolicy::class);
        Factory::guessFactoryNamesUsing(static function (string $name) {
            return 'Spd\User\Database\Factories\\' . class_basename($name) . 'Factory';
        });
    }

    public function boot()
    {
        config()->set('panelConfig.menus.users', [
            'url'   => route('users.index'),
            'title' => 'کاربران',
            'icon'  => 'account',
            'permissions' => [
                Permission::PERMISSION_USERS
            ]
        ]);
    }
}
