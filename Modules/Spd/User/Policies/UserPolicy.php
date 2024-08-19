<?php

namespace Spd\User\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Spd\Role\Models\Permission;
use Spd\User\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function index(User $user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_USERS)) {
            return true;
        }
    }
}
