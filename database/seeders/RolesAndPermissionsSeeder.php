<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //
        Permission::create(['name'  => 'view product']);
        Permission::create(['name'  => 'add product']);
        Permission::create(['name'  => 'edit product']);
        Permission::create(['name'  => 'edit all product']);
        Permission::create(['name'  => 'delete product']);
        Permission::create(['name'  => 'delete all product']);
        Permission::create(['name'  => 'edit profile']);
        Permission::create(['name'  => 'edit all profile']);
        Permission::create(['name'  => 'delete profile']);
        Permission::create(['name'  => 'delete all profile']);
        Permission::create(['name'  => 'view profile']);
        Permission::create(['name'  => 'view all profile']);
        Permission::create(['name'  => 'add category']);
        Permission::create(['name'  => 'edit category']);
        Permission::create(['name'  => 'delete category']);
        Permission::create(['name'  => 'view category']);
        Permission::create(['name'  => 'view all category']);
        Permission::create(['name'  => 'view role']);
        Permission::create(['name'  => 'add role']);
        Permission::create(['name'  => 'edit role']);
        Permission::create(['name'  => 'change role user']);
        Permission::create(['name'  => 'delete role']);
       
        
        
        // this can be done as separate statements
        $roleAdmin = Role::create(['name'=>'admin']);
        $roleAdmin->givePermissionTo(Permission::all());
        $roleSeller = Role::create(['name' => 'seller']);
        $roleSeller->givePermissionTo(['view product','add product','edit product','delete product',
        'edit profile','delete profile','view profile']);
        $roleUser = Role::create(['name'=>'user']);
        $roleUser->givePermissionTo(['edit profile','delete profile','view profile']);

}
}