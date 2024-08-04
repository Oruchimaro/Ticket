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
        Role::find(1)->permissions()->sync($admin_permissions);

        $agent_permissions = Permission::whereIn('name', [
            'category_access',
            'category_show',
            'ticket_access',
            'ticket_show',
        ])->get();

        Role::find(2)->permissions()->sync($agent_permissions);
    }
}
