<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserRole
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function superAdmin(User $user){
        return $user->hasRole('super admin');
    }

    public function admin(User $user){
        return $user->hasRole('admin');
    }

    public function subAdmin(User $user){
        return $user->hasRole('subadmin');
    }

    public function superMaster(User $user){
        return $user->hasRole('supermaster');
    }

    public function master(User $user){
        return $user->hasRole('master');
    }

    public function user(User $user){
        return $user->hasRole('user');
    }
}
