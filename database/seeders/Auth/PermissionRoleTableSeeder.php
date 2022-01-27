<?php

namespace Database\Seeders\Auth;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        // Create Roles
        $super_admin = Role::create(['name' => 'super admin']);
        $admin = Role::create(['name' => 'admin']);
        $manager = Role::create(['name' => 'subadmin']);
        $executive = Role::create(['name' => 'supermaster']);
        $master = Role::create(['name' => 'master']);
        $user = Role::create(['name' => 'user']);

        // Create Permissions
        Permission::firstOrCreate(['name' => 'view_backend']);
        Permission::firstOrCreate(['name' => 'view_settings']);
        Permission::firstOrCreate(['name' => 'edit_settings']);
        

        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $perms) {
            Permission::firstOrCreate(['name' => $perms]);
        }

        
        echo "\n\n";

        // Assign Permissions to Roles
        $super_admin->givePermissionTo(Permission::all());
        /*$manager->givePermissionTo('view_backend');

        $executive->givePermissionTo('view_backend');*/

        Schema::enableForeignKeyConstraints();
    }
}
