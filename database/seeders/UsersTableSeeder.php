<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'am@am.am',
                'password' => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'name' => 'Agent',
                'email' => 'ad@ad.ad',
                'password' => bcrypt('password'),
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
