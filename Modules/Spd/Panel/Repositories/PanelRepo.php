<?php

namespace Spd\Panel\Repositories;

use Spd\Article\Models\Article;
use Spd\Category\Models\Category;
use Spd\Comment\Models\Comment;
use Spd\Role\Models\Permission;
use Spd\User\Models\User;

class PanelRepo
{
    public function user_count()
    {
        return User::query()->count();
    }

    public function article_count()
    {
        return Article::query()->count();
    }

    public function comment_count()
    {
        return Comment::query()->count();
    }

    public function cat_count()
    {
        return Category::query()->count();
    }

    public function getLatestAuthorUsers()
    {
        return User::query()->permission(Permission::PERMISSION_AUTHORS)->latest()->limit(4)->get();
    }

    public function getLatestArticles()
    {
        return Article::query()->latest()->limit(10)->get();
    }
}
