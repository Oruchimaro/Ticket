<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'id' => 1,
                'name' => Role::ROLES['Admin'],
            ],
            [
                'id' => 2,
                'name' => Role::ROLES['Agent'],
            ],
        ];

        Role::insert($roles);
    }
}
