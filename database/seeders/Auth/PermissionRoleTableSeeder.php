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
       //Admin
        $admin->givePermissionTo('view_backend');
        $admin->givePermissionTo('view_settings');
        $admin->givePermissionTo('edit_settings');
        $admin->givePermissionTo('view_users');
        $admin->givePermissionTo('add_users');
        $admin->givePermissionTo('edit_users');
        $admin->givePermissionTo('delete_users');
        $admin->givePermissionTo('view_matches');
        $admin->givePermissionTo('view_user_dashboard');
        $admin->givePermissionTo('view_bet_history_report');
        $admin->givePermissionTo('view_current_bet_report');
        $admin->givePermissionTo('view_account_statement');
        $admin->givePermissionTo('view_profit_loss_report');
        $admin->givePermissionTo('store_betting_limit');
       //Subadmin
        $manager->givePermissionTo('view_backend');
        $manager->givePermissionTo('view_settings');
        $manager->givePermissionTo('edit_settings');
        $manager->givePermissionTo('view_users');
        $manager->givePermissionTo('add_users');
        $manager->givePermissionTo('edit_users');
        $manager->givePermissionTo('delete_users');
        $manager->givePermissionTo('view_matches');
        $manager->givePermissionTo('view_user_dashboard');
        $manager->givePermissionTo('view_bet_history_report');
        $manager->givePermissionTo('view_current_bet_report');
        $manager->givePermissionTo('view_account_statement');
        $manager->givePermissionTo('view_profit_loss_report');
        $manager->givePermissionTo('store_betting_limit');
        //SuperMaster
        $executive->givePermissionTo('view_backend');
        $executive->givePermissionTo('view_settings');
        $executive->givePermissionTo('edit_settings');
        $executive->givePermissionTo('view_users');
        $executive->givePermissionTo('add_users');
        $executive->givePermissionTo('edit_users');
        $executive->givePermissionTo('delete_users');
        $executive->givePermissionTo('view_matches');
        $executive->givePermissionTo('view_user_dashboard');
        $executive->givePermissionTo('view_bet_history_report');
        $executive->givePermissionTo('view_current_bet_report');
        $executive->givePermissionTo('view_account_statement');
        $executive->givePermissionTo('view_profit_loss_report');
        $executive->givePermissionTo('store_betting_limit');
        //Master
        $master->givePermissionTo('view_backend');
        $master->givePermissionTo('view_settings');
        $master->givePermissionTo('edit_settings');
        $master->givePermissionTo('view_users');
        $master->givePermissionTo('add_users');
        $master->givePermissionTo('edit_users');
        $master->givePermissionTo('delete_users');
        $master->givePermissionTo('view_matches');
        $master->givePermissionTo('view_user_dashboard');
        $master->givePermissionTo('view_bet_history_report');
        $master->givePermissionTo('view_current_bet_report');
        $master->givePermissionTo('view_account_statement');
        $master->givePermissionTo('view_profit_loss_report');
        $master->givePermissionTo('store_betting_limit');
        //User        
        $user->givePermissionTo('view_backend');
        $user->givePermissionTo('view_bets');
        $user->givePermissionTo('users_dashboard');
        $user->givePermissionTo('view_bet_history_report');
        $user->givePermissionTo('view_current_bet_report');
        $user->givePermissionTo('view_account_statement');
        $user->givePermissionTo('view_profit_loss_report');
        $user->givePermissionTo('store_betting_limit');
        
        Schema::enableForeignKeyConstraints();
    }
}
