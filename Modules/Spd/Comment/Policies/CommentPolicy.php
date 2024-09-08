<?php

namespace Spd\Comment\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Spd\Role\Models\Permission;
use Spd\User\Models\User;

class CommentPolicy
{
    use HandlesAuthorization;


    public function __construct()
    {
        //
    }

    public function manage(User $user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_COMMENTS)) {
            return true;
        }
    }
}
