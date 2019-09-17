<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function create($request): User
    {   
        $userData = $request->all();
        array_key_exists('is_admin', $userData) ? $userData['is_admin'] = true : $userData['is_admin'] = false;
        array_key_exists('is_active', $userData) ? $userData['is_active'] = true : $userData['is_active'] = false;

        $userData['password'] = Hash::make($userData['password']);
        return User::create($userData);
    }

    public function update($request, $id): User
    {
        $userData = $request->all();
        array_key_exists('is_admin', $userData) ? $userData['is_admin'] = true : $userData['is_admin'] = false;
        array_key_exists('is_active', $userData) ? $userData['is_active'] = true : $userData['is_active'] = false;
        
        if($userData['password'] != '********') {
            $userData['password'] = Hash::make($userData['password']);
        }
        
        $user = User::find($id);
        $user->update($userData);
        return $user;
    }

    public function delete($id): User
    {
        $user = User::find($id);
        $user->delete();
        return $user;
    }
}