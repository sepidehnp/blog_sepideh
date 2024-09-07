<?php

namespace Spd\User\Http\Controllers\Home;

use Spd\Role\Models\Permission;
use Spd\User\Services\UserService;
use App\Http\Controllers\Controller;
use Spd\Share\Services\ShareService;
use Spd\Share\Repositories\ShareRepo;
use Spd\User\Repositories\Home\UserRepo;
use Spd\Article\Repositories\ArticleRepo;
use Spd\User\Http\Requests\UpdateProfileRequest;

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

    public function profile()
    {
        return view('User::Home.profile');
    }

    public function updateProfile(UpdateProfileRequest $request, UserService $userService)
    {
        if ($request->image) {
            [$imageName, $imagePath] = ShareService::uploadImage($request->file('image'), 'users');
        } else {
            $imageName = auth()->user()->imageName;
            $imagePath = auth()->user()->imagePath;
        }

        $userService->updateProfile($request, auth()->id(), $imageName, $imagePath);

        ShareRepo::successMessage('بروزرسانی پروفایل کاربری');
        return back();
    }
}
