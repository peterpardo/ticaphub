<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin1 = User::create([
            'first_name' => 'SuperAdmin',
            'middle_name' => '',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'), // password
            'ticap_id' => null,
            'email_verified' => 1,
        ]);

        // CREATE PERMISSIONS
        // ADMIN / CHAIRMAN / OFFICERS
        Permission::create(['name' => 'access users']);
        Permission::create(['name' => 'access events']);
        Permission::create(['name' => 'access awards']);
        Permission::create(['name' => 'access asessment']);
        Permission::create(['name' => 'access documents']);
        Permission::create(['name' => 'access group exhibit']);
        Permission::create(['name' => 'view event']);
        Permission::create(['name' => 'add event']);
        Permission::create(['name' => 'delete event']);
        Permission::create(['name' => 'edit event']);
        Permission::create(['name' => 'view list']);
        Permission::create(['name' => 'add list']);
        Permission::create(['name' => 'delete list']);
        Permission::create(['name' => 'edit list']);
        Permission::create(['name' => 'view task']);
        Permission::create(['name' => 'add task']);
        Permission::create(['name' => 'delete task']);
        Permission::create(['name' => 'edit task']);
        Permission::create(['name' => 'move task']);
        Permission::create(['name' => 'add member']);
        Permission::create(['name' => 'add report']);
        Permission::create(['name' => 'appoint committee head']);
        Permission::create(['name' => 'assign task to student']);
        Permission::create(['name' => 'generate report']);
        Permission::create(['name' => 'set schedule']);
        Permission::create(['name' => 'access slider']);
        // PANELIST
        Permission::create(['name' => 'evaluate']);

        // CREATE ROLES AND ASSIGN PERMISSIONS
        // ADMIN
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('access users');
        $admin->givePermissionTo('access events');
        $admin->givePermissionTo('access awards');
        $admin->givePermissionTo('access asessment');
        $admin->givePermissionTo('access documents');
        $admin->givePermissionTo('add event');
        $admin->givePermissionTo('delete event');
        $admin->givePermissionTo('edit event');
        $admin->givePermissionTo('view event');
        $admin->givePermissionTo('add list');
        $admin->givePermissionTo('edit list');
        $admin->givePermissionTo('delete list');
        $admin->givePermissionTo('view list');
        $admin->givePermissionTo('add task');
        $admin->givePermissionTo('edit task');
        $admin->givePermissionTo('delete task');
        $admin->givePermissionTo('view task');
        $admin->givePermissionTo('move task');
        $admin->givePermissionTo('add member');
        $admin->givePermissionTo('add report');
        $admin->givePermissionTo('appoint committee head');
        $admin->givePermissionTo('generate report');
        $admin->givePermissionTo('set schedule');
        $admin->givePermissionTo('access slider');

        // CHAIRMAN
        $chairman = Role::create(['name' => 'chairman']);
        $chairman->givePermissionTo('access events');
        $chairman->givePermissionTo('access asessment');
        $chairman->givePermissionTo('view event');
        $chairman->givePermissionTo('add list');
        $chairman->givePermissionTo('edit list');
        $chairman->givePermissionTo('delete list');
        $chairman->givePermissionTo('view list');
        $chairman->givePermissionTo('add task');
        $chairman->givePermissionTo('edit task');
        $chairman->givePermissionTo('delete task');
        $chairman->givePermissionTo('view task');
        $chairman->givePermissionTo('move task');
        $chairman->givePermissionTo('add member');
        $chairman->givePermissionTo('add report');
        $chairman->givePermissionTo('appoint committee head');
        $chairman->givePermissionTo('access slider');
        $chairman->givePermissionTo('set schedule');

        // OFFICER
        $officer = Role::create(['name' => 'officer']);
        $officer->givePermissionTo('access events');
        $officer->givePermissionTo('view event');
        $officer->givePermissionTo('view list');
        $officer->givePermissionTo('view task');
        $officer->givePermissionTo('add task');
        $officer->givePermissionTo('edit task');
        $officer->givePermissionTo('delete task');
        $officer->givePermissionTo('move task');
        $officer->givePermissionTo('add report');
        // PANELIST
        $panelist = Role::create(['name' => 'panelist']);
        $panelist->givePermissionTo('evaluate');
        // STUDENT
        $student = Role::create(['name' => 'student']);
        $student->givePermissionTo('access group exhibit');
        // ASSIGN ROLE
        $admin1->assignRole($admin);
    }
}
