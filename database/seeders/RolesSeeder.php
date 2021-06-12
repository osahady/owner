<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //roles
        $admin = Role::create(['name'=>'admin']);
        $announcer = Role::create(['name'=>'announcer']);

        //premissions
        $approve = Permission::create(['name'=>'approve ads']);
        $create = Permission::create(['name'=>'create ads']);
        $read = Permission::create(['name'=>'read ads']);
        $update = Permission::create(['name'=>'update ads']);
        $delete = Permission::create(['name'=>'delete ads']);

        //role has premissions
        $admin->syncPermissions($approve, $delete);
        $announcer->syncPermissions($create, $read, $update, $delete);

        //model has roles
        User::find(1)->assignRole($admin);
        User::find(2)->assignRole($announcer);
    }
}
