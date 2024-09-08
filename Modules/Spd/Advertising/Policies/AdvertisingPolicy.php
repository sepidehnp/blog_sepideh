<?php
namespace Spd\Advertising\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Spd\Role\Models\Permission;
use Spd\User\Models\User;

class AdvertisingPolicy
{
    use HandlesAuthorization;

    
    public function __construct()
    {
        //
    }

    public function index(User $user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_ADVERTISINGS)) {
            return true;
        }
    }
}
