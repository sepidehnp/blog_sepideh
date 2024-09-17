<?php

namespace Spd\Comment\Providers;

use Spd\Comment\Models\Comment;
use Spd\Role\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Spd\Comment\Policies\CommentPolicy;

class CommentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'Comment');
        Route::middleware('web')->namespace('Spd\Comment\Http\Controllers')
        ->group(__DIR__ . '/../Routes/comment_routes.php');
        Gate::policy(Comment::class, CommentPolicy::class);
    }

    public function boot()
    {
        config()->set('panelConfig.menus.comments', [
            'url'   => route('comments.index'),
            'title' => 'نظرات',
            'icon'  => 'comment',
            'permissions' => [
                Permission::PERMISSION_COMMENTS
            ]
        ]);
    }
}
