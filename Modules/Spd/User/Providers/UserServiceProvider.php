<?php

namespace Spd\User\Providers;

use Spd\User\Models\User;
use Spd\User\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'User');
        Route::middleware('web')->namespace('Spd\User\Http\Controllers')->group(__DIR__ . '/../Routes/user_routes.php');

        Gate::policy(User::class, UserPolicy::class);
    }

    public function boot()
    {
        config()->set('panelConfig.menus.users', [
            'url'   => route('users.index'),
            'title' => 'کاربران',
            'icon'  => 'account',
        ]);
    }
}
