<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function create($request): User
    {
        $userData = $request->validated();

        $userData['password'] = Hash::make($userData['password']);
        $userData['api_token'] = \Str::random(60);
        
        return User::create($userData);
    }

    public function update($request, $id): User
    {
        $userData = $request->validated();

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
