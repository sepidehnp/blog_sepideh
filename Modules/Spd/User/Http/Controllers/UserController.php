<?php
namespace Spd\User\Http\Controllers;

use Spd\User\Models\User;
use Spd\User\Services\UserService;
use Spd\Role\Repositories\RoleRepo;
use Spd\User\Repositories\UserRepo;
use Spd\Share\Http\Controllers\Controller;
use Spd\User\Http\Requests\UserRequest;
use Spd\User\Http\Requests\AddRoleRequest;
use Spd\User\Http\Requests\UserUpdateRequest;



class UserController extends Controller
{
    // SOLID
    // S => Single Responsibility Principle
    //    public function show($id)
    //    {
    //        abort(404);
    //    }
    private string $class = User::class;
    public UserRepo $repo;
    public UserService $service;
    public function __construct(UserRepo $userRepo, UserService $userService)
    {
        $this->repo = $userRepo;
        $this->service = $userService;
    }

    public function index()
    {
        $this->authorize('index', $this->class);
        $users = $this->repo->index();

        return view('User::index', compact('users'));
    }

    public function create()
    {
        $this->authorize('index', $this->class);
        return view('User::create');
    }

    public function store(UserRequest $request)
    {
        $this->authorize('index', $this->class);
        $this->service->store($request);

        return to_route('users.index');
    }

    public function edit($id)
    {
        $this->authorize('index', $this->class);
        $user = $this->repo->findById($id);

        return view('User::edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $this->authorize('index', $this->class);
        $this->service->update($request, $id);

        return to_route('users.index');
    }

    public function destroy($id)
    {
        $this->authorize('index', $this->class);
        $this->repo->delete($id);

        return to_route('users.index')->with(['success_delete' => 'کاربر با موفقیت حذف شد']);
    }

    // Role
    public function addRole($user_id, RoleRepo $roleRepo)
    {
        $this->authorize('index', $this->class);
        $roles = $roleRepo->index()->get();

        return view('User::add-roles', compact(['user_id', 'roles']));
    }

    public function addRoleStore(AddRoleRequest $request, $userId)
    {
        $this->authorize('index', $this->class);
        $user = $this->repo->findById($userId);
        $this->service->addRole($request->role, $user);

        alert()->success('اد کردن مقام به کاربر', 'عملیات با موفقیت انجام شد');
        return to_route('users.index');
    }

    public function removeRole($userId, $roleId, RoleRepo $roleRepo)
    {
        $this->authorize('index', $this->class);
        $user = $this->repo->findById($userId);
        $role = $roleRepo->findById($roleId);
        $this->service->deleteRole($user, $role->name);
        alert()->success('حذف کردن مقام', 'عملیات با موفقیت انجام شد');
        return to_route('users.index');
    }
}

