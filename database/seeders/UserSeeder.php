<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'Admin User',
                'email' => 'admin@test.com',
                'password' => bcrypt('admin'),
                'role' => 'admin',
            ]
        );

        User::create(
            [
                'name' => 'Guest User',
                'email' => 'guest@test.com',
                'password' => bcrypt('guest'),
                'role' => 'user',
            ]
        );
    }
}

