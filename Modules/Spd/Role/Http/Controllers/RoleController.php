<?php

namespace Spd\Role\Http\Controllers;

use Spd\Role\Models\Role;
use Spd\Role\Services\RoleService;
use Spd\Role\Repositories\RoleRepo;
use Spd\Share\Http\Controllers\Controller;
use Spd\Role\Http\Requests\RoleRequest;
use Spd\Role\Repositories\PermissionRepo;

class RoleController extends Controller
{
    private string $class = Role::class;
    public RoleRepo $repo;
    public RoleService $service;

    public function __construct(RoleRepo $roleRepo, RoleService $roleService)
    {
        $this->repo = $roleRepo;
        $this->service = $roleService;
    }

    public function index()
    {
        $this->authorize('index', $this->class);
        $roles = $this->repo->index()->paginate(10);

        return view('Role::index', compact('roles'));
    }

    public function create(PermissionRepo $permissionRepo)
    {
        $this->authorize('index', $this->class);
        $permissions = $permissionRepo->all();

        return view('Role::create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        $this->authorize('index', $this->class);
        $this->service->store($request);

        alert()->success('ساخت مقام', 'مقام با موفقیت ساخته شد');
        return to_route('roles.index');
    }

    public function edit($id, PermissionRepo $permissionRepo)
    {
        $this->authorize('index', $this->class);
        $role = $this->repo->findById($id);
        $permissions = $permissionRepo->all();

        return view('Role::edit', compact(['role', 'permissions']));
    }

    public function update(RoleRequest $request, $id)
    {
        $this->authorize('index', $this->class);
        $this->service->update($request, $id);

        alert()->success('ویرایش مقام', 'مقام با موفقیت ویرایش شد');
        return to_route('roles.index');
    }

    public function destroy($id)
    {
        $this->authorize('index', $this->class);
        $this->repo->delete($id);

        alert()->success('حذف مقام', 'مقام با موفقیت حذف شد');
        return to_route('roles.index');
    }
}
