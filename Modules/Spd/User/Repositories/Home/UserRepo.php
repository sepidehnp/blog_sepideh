<?php

namespace Spd\User\Repositories\Home;

use Spd\Role\Models\Permission;
use Spd\User\Models\User;

class UserRepo
{
    public function authors()
    {
        return $this->query()->permission(Permission::PERMISSION_AUTHORS)->latest();
    }

    public function findByName($name)
    {
        return $this->query()->whereName($name);
    }

    private function query()
    {
        return User::query();
    }
}
