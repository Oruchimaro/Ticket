<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'permission',
            'role',
            'category',
            'ticket',
            'user',
        ];

        $insertData = [];
        foreach ($permissions as $permission) {
            $insertData[] = [
                'name' => $permission.'_create',
            ];
            $insertData[] = [
                'name' => $permission.'_edit',
            ];
            $insertData[] = [
                'name' => $permission.'_delete',
            ];
            $insertData[] = [
                'name' => $permission.'_show',
            ];
            $insertData[] = [
                'name' => $permission.'_access',
            ];
        }

        Permission::insert($insertData);
    }
}
