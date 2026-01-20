<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionAndGroupSeeder extends Seeder
{
    private array $GROUPS_NAME;
    private array $PERMS_NAME;

    public function __construct() {
        $rolesConfig = config('admin.roles');
        $this->GROUPS_NAME = array_merge([
            'Super Admin',
        ], array_map(fn($role) => $role['label'], $rolesConfig));
        $this->PERMS_NAME = config('admin.permissions');
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [];
        $permissions = [];
        foreach ($this->GROUPS_NAME as $group_name) {
            $groups[$group_name] = Role::findOrCreate($group_name);
        }

        foreach ($this->PERMS_NAME as $perm_name) {
            $permissions[$perm_name] = Permission::findOrCreate($perm_name);
        }

        $rolesConfig = config('admin.roles');
        foreach ($rolesConfig as $roleKey => $roleConfig) {
            $role_name = $roleConfig['label'];
            $role = $groups[$role_name];

            if (!$role) continue;

            $perms_to_assign = $roleConfig['permissions'];

            if (in_array('*', $perms_to_assign)) {
                $role->syncPermissions($this->PERMS_NAME);
            } else {
                $role->syncPermissions($perms_to_assign);
            }
        }

        if (isset($groups['Super Admin'])) {
            $groups['Super Admin']->syncPermissions($this->PERMS_NAME);
        }
    }
}
