<?php

namespace Spd\Home\Repositories;

use Spd\User\Models\User;
use Spd\Article\Models\Article;
use Spd\Role\Models\Permission;
use Spd\Category\Models\Category;

class HomeRepo
{
    public function vip_posts()
    {
        return Article::query()->where('status', Article::STATUS_ACTIVE)->whereType(Article::TYPE_VIP)->latest();
    }

    public function getActiveCategories()
    {
        return Category::query()->whereStatus(Article::STATUS_ACTIVE)->latest()->get();
    }

    public function getVipArticlesOrderByView()
    {
        return Article::query()->where('status', Article::STATUS_ACTIVE)->whereType(Article::TYPE_VIP)->orderByViews()->latest()->limit(5)->get();
    }

    public function getAuthorUsers()
    {
        return User::query()->permission(Permission::PERMISSION_AUTHORS)->limit(20)->get();
    }

    public function getArticlesOrderByView()
    {
        return Article::query()->where('status', Article::STATUS_ACTIVE)->whereType(Article::TYPE_NORMAL)
        ->orderByViews()->latest()->limit(3)->get();
    }

    public function getNewArticles()
    {
        return Article::query()->whereStatus(Article::STATUS_ACTIVE)->whereType(Article::TYPE_NORMAL)->latest()->limit(8)->get();
    }
}
