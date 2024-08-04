<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run(): void
    {
        $admin_permissions = Permission::all();
        $agent_permissions = Permission::where('name', 'LIKE', 'ticket_%')
            ->orWhere('name', 'LIKE', 'category_%')
            ->get();

        Role::find(1)->permissions()->sync($admin_permissions);
        Role::find(2)->permissions()->sync($agent_permissions);
    }
}
