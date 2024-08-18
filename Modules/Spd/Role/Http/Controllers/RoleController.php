<?php

namespace Spd\Role\Http\Controllers;

use Spd\Role\Http\Requests\RoleRequest;
use Spd\Role\Repositories\PermissionRepo;
use Spd\Role\Services\RoleService;
use Spd\Role\Repositories\RoleRepo;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public RoleRepo $repo;
    public RoleService $service;

    public function __construct(RoleRepo $roleRepo, RoleService $roleService)
    {
        $this->repo = $roleRepo;
        $this->service = $roleService;
    }

    public function index()
    {
        //
        $roles = $this->repo->index()->paginate(10);
        return view('Role::index', compact('roles'));
    }


    public function create(PermissionRepo $permissionRepo)
    {
        //
        $permissions = $permissionRepo->all();
        return view('Role::create', compact('permissions'));
    }


    public function store(RoleRequest $request)
    {
        //
        $this->service->store($request);
        alert()->success('ساخت مقام', 'مقام با موفقیت ساخته شد');
        return to_route('roles.index');
    }


    public function edit($id, PermissionRepo $permissionRepo)
    {
        //
        $role = $this->repo->findById($id);
        $permissions = $permissionRepo->all();

        return view('Role::edit', compact(['role', 'permissions']));
    }


    public function update(RoleRequest $request, $id)
    {
        //
        $this->service->update($request, $id);
        alert()->success('ویرایش مقام', 'مقام با موفقیت ویرایش شد');
        return to_route('roles.index');
    }


    public function destroy($id)
    {
        //
        $this->repo->delete($id);
        alert()->success('حذف مقام', 'مقام با موفقیت حذف شد');
        return to_route('roles.index');
    }
}
