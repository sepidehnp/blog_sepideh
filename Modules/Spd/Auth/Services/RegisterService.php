<?php

namespace Spd\Auth\Services;

use Spd\User\Models\User;

class RegisterService
{
    public function generateUser($request) 
    {
        return User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    }
}
