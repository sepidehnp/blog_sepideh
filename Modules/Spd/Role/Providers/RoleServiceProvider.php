<?php

namespace Spd\Role\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Spd\Role\Database\Seeders\PermissionSeeder;
use Spd\Role\Models\Permission;
use Spd\Role\Models\Role;
use Spd\Role\Policies\RolePolicy;

class RoleServiceProvider extends ServiceProvider

{
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Role');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations/');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang/');

        Route::middleware('web')->namespace('Spd\Role\Http\Controllers')
        ->group(__DIR__ . '/../Routes/role_routes.php');
        DatabaseSeeder::$seeders[] = PermissionSeeder::class;

        Gate::policy(Role::class, RolePolicy::class);
        Gate::before(static function ($user) {
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });
    }

    public function boot()
    {
        config()->set('panelConfig.menus.roles', [
            'url'   => route('roles.index'),
            'title' => 'مقام ها',
            'icon'  => 'bug',
            'permissions' => [Permission::PERMISSION_ROLES]
        ]);
    }

}
