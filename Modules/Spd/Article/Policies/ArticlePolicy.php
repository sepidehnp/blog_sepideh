<?php

namespace Spd\Article\Policies;

use Spd\User\Models\User;
use Spd\Role\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;


    public function __construct()
    {
        //
    }
    public function manage(User $user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_ARTICLES)) {
            return true;
        }
    }
}
