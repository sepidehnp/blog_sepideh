<?php

namespace Spd\Panel\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Spd\Role\Models\Permission;
use Spd\User\Models\User; 

class PanelPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function index(User $user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_PANEL)) {
            return true;
        }
    }
}
