<?php

namespace Spd\User\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Spd\Article\Repositories\ArticleRepo;
use Spd\Role\Models\Permission;
use Spd\User\Repositories\Home\UserRepo;

class UserController extends Controller
{
    public UserRepo $repo;

    public function __construct(UserRepo $userRepo)
    {
        $this->repo = $userRepo;
    }

    public function authors()
    {
        $authors = $this->repo->authors()->paginate(50);
        return view('User::Home.authors', compact('authors'));
    }

    public function author($name, ArticleRepo $articleRepo)
    {
        $author = $this->repo->findByName($name)->permission(Permission::PERMISSION_AUTHORS)->first();

        if (is_null($author)) abort(404);
        $articles = $articleRepo->getArticlesByUserId($author->id)->paginate(10);

        return view('User::Home.author', compact(['author', 'articles']));
    }
}
