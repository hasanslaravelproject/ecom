<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list ordercategories']);
        Permission::create(['name' => 'view ordercategories']);
        Permission::create(['name' => 'create ordercategories']);
        Permission::create(['name' => 'update ordercategories']);
        Permission::create(['name' => 'delete ordercategories']);

        Permission::create(['name' => 'list productcategories']);
        Permission::create(['name' => 'view productcategories']);
        Permission::create(['name' => 'create productcategories']);
        Permission::create(['name' => 'update productcategories']);
        Permission::create(['name' => 'delete productcategories']);

        Permission::create(['name' => 'list menutypes']);
        Permission::create(['name' => 'view menutypes']);
        Permission::create(['name' => 'create menutypes']);
        Permission::create(['name' => 'update menutypes']);
        Permission::create(['name' => 'delete menutypes']);

        Permission::create(['name' => 'list units']);
        Permission::create(['name' => 'view units']);
        Permission::create(['name' => 'create units']);
        Permission::create(['name' => 'update units']);
        Permission::create(['name' => 'delete units']);

        Permission::create(['name' => 'list setups']);
        Permission::create(['name' => 'view setups']);
        Permission::create(['name' => 'create setups']);
        Permission::create(['name' => 'update setups']);
        Permission::create(['name' => 'delete setups']);

        Permission::create(['name' => 'list companies']);
        Permission::create(['name' => 'view companies']);
        Permission::create(['name' => 'create companies']);
        Permission::create(['name' => 'update companies']);
        Permission::create(['name' => 'delete companies']);

        Permission::create(['name' => 'list products']);
        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'update products']);
        Permission::create(['name' => 'delete products']);

        Permission::create(['name' => 'list orders']);
        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'create orders']);
        Permission::create(['name' => 'update orders']);
        Permission::create(['name' => 'delete orders']);

        Permission::create(['name' => 'list customers']);
        Permission::create(['name' => 'view customers']);
        Permission::create(['name' => 'create customers']);
        Permission::create(['name' => 'update customers']);
        Permission::create(['name' => 'delete customers']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
