<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CREATE PERMISSIONS
        Permission::create(['name' => 'can access events']);
        Permission::create(['name' => 'can evaluate']);

        // CREATE ROLES AND ASSIGN PERMISSIONS
        $chairman = Role::create(['name' => 'chairman']);
        $officer = Role::create(['name' => 'officer']);
        $panelist = Role::create(['name' => 'panelist']);

        $chairman->givePermissionTo('can access events');
        $officer->givePermissionTo('can access events');
        $panelist->givePermissionTo('can evaluate');
        
    }
}
