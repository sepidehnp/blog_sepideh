<?php
namespace Spd\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spd\User\Http\Requests\UserRequest;
use Spd\User\Http\Requests\UserUpdateRequest;
use Spd\User\Models\User; 
use Spd\User\Repositories\UserRepo;
use Spd\User\Services\UserService;



class UserController extends Controller
{
    // SOLID
    // S => Single Responsibility Principle
    //    public function show($id)
    //    {
    //        abort(404);
    //    }
    public UserRepo $repo;
    public UserService $service;
    public function __construct(UserRepo $userRepo, UserService $userService)
    {
        $this->repo = $userRepo;
        $this->service = $userService;
    }
    public function index()
    {
        $users = $this->repo->index();
        return view('User::index', compact('users'));
    }
    public function create()
    {
        return view('User::create');
    }
    public function store(UserRequest $request)
    {
        $this->service->store($request);
        return to_route('users.index');
    }
    public function edit($id)
    {
        $user = $this->repo->findById($id);
        return view('User::edit', compact('user'));
    }
    public function update(UserUpdateRequest $request, $id)
    {
        $this->service->update($request, $id);
        return to_route('users.index');
    }
    public function destroy($id)
    {
        $this->repo->delete($id);

        return to_route('users.index')->with(['success_delete' => 'کاربر با موفقیت حذف شد']);
    }
}
