<?php

namespace Spd\User\Services;


use Spd\User\Models\User;

class UserService
{
    public function store($request)
    {
        return User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
//            'password' => Hash::make($request->password),
        ]);
    }

    public function update($request, $id)
    {
        return User::query()->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    }
    public function addRole($role, $user)
    {
        return $user->assignRole($role);
    }

    public function deleteRole($user, $role)
    {
        return $user->removeRole($role);
    }

    public function updateProfile($request, $id, $imageName, $imagePath)
    {

        $data= [
            'name' => $request->name,
            'email' => $request->email,
            'telegram' => $request->telegram,
            'linkedin' => $request->linkedin,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'bio' => $request->bio,
            'imageName' => $imageName,
            'imagePath' => $imagePath,
        ];
        if($request->password){
            $data['password']=bcrypt($request->password);
        }

        return User::query()->where('id',$id)->update($data);
        
        // return User::query()->where('id', $id)->update([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => $request->has('password') ? bcrypt($request->password):$user->password,
        //     'telegram' => $request->telegram,
        //     'linkedin' => $request->linkedin,
        //     'twitter' => $request->twitter,
        //     'instagram' => $request->instagram,
        //     'bio' => $request->bio,
        //     'imageName' => $imageName,
        //     'imagePath' => $imagePath,
        // ]);
    }
}



