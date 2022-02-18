<?php

namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission
{
    /**
     * Default Permissions of the Application.
     */
    public static function defaultPermissions()
    {
        return [
            'view_users',
            'add_users',
            'edit_users',
            'delete_users',
            'restore_users',
            'block_users',

            'view_roles',
            'add_roles',
            'edit_roles',
            'delete_roles',
            'restore_roles',

            'view_matches',
            'add_matches',
            'edit_matches',
            'delete_matches',

            'view_eventmanagers',
            'add_eventmanagers',
            'edit_eventmanagers',
            'delete_eventmanagers',

            'view_matchevents',
            'add_matchevents',
            'edit_matchevents',
            'delete_matchevents',

            'view_bets',
            'add_bets',
            'edit_bets',
            'delete_bets',

            'view_user_dashboard',
            'users_dashboard',
            'view_bet_history_report',
            'view_current_bet_report',
            'view_account_statement',
            'view_profit_loss_report',
            'store_betting_limit'
        ];
    }

    /**
     * Name should be lowercase.
     *
     * @param string $value Name value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
}
