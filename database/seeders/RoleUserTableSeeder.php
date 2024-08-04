<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run(): void
    {
        User::find(1)->roles()->sync(1);
        User::find(2)->roles()->sync(2);
    }
}
