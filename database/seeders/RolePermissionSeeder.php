<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $superAdminRole = Role::create(['name' => 'super admin']);
        $userRole       = Role::create(['name'=> 'editor user']);

        //permission group wise 
        $permissionGroups = [
            'dashboard' =>[
                'admin.dashboard', //for both
                
            ],
            'users' =>[
                'users.list',
                'users.create',
                'users.edit', //member can edit only own
                'users.update',
                'users.delete',
            ],
            'roles' =>[
                'roles.list',
                'roles.create',
                'roles.edit', //member can edit only own
                'roles.update',
                'roles.delete',
            ],
            'post' => [
                'post.index',
                'post.create',
                'post.edit', //user can edit
                'post.update', //user can edit
                'post.destroy',
            ]
        ];
        $userPermission = [
            'dashboard.view',
            'users.edit',
            'users.edit',
            'users.update',
            'users.delete'
        ];
        //insert the permission and assign it to a role
        foreach ($permissionGroups as $permissionGroupsKey => $permissions) {
           foreach ($permissions as  $permissionName) {
               $permission = Permission::create([
                   'group_name' => $permissionGroupsKey,
                   'name'       => $permissionName,
               ]);

               $superAdminRole->givePermissionTo($permission);
               $permission->assignRole($superAdminRole);

               if (in_array($permissionName, $userPermission)) {
                    $userRole->givePermissionTo($permission);
                    $permission->assignRole($userRole);
               }
           }
        }
    }
}
