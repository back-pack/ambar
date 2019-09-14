<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Admin', 'email' => 'admin@admin.com', 'password' => Hash::make('Pass.001'), 'phone' => '12345678', 'is_admin' => true, 'is_active' => true]
        ];

        foreach ($users as $user) {
            \DB::table('users')->insert($user);
        }
    }
}