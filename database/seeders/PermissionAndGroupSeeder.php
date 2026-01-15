<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionAndGroupSeeder extends Seeder
{
    const GROUPS_NAME = [
        'Super Admin'
    ];

    const PERMS_NAME = config('admin.permissions');
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [];
        $permissions = [];
        foreach (self::GROUPS_NAME as $group_name) {
            $groups[$group_name] = Role::findOrCreate($group_name);
        }

        foreach (self::PERMS_NAME as $perm_name) {
            $permissions[$perm_name] = Permission::findOrCreate($perm_name);
        }

        $rolesConfig = config('admin.roles');
        foreach ($rolesConfig as $roleKey => $roleConfig) {
            $role_name = $roleConfig['label'];
            $role = $groups[$role_name];

            if (!$role) continue;

            $perms_to_assign = $roleConfig['permissions'];

            if (in_array('*', $perms_to_assign)) {
                $role->syncPermissions(self::PERMS_NAME);
            } else {
                $role->syncPermissions($perms_to_assign);
            }
        }

        if (isset($groups['Super Admin'])) {
            $groups['Super Admin']->syncPermissions(self::PERMS_NAME);
        }
    }
}
