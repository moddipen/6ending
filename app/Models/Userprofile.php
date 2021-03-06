<?php

namespace App\Models;

class Userprofile extends BaseModel
{
    protected $dates = [
        'date_of_birth',
        'last_login',
        'email_verified_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function parent_limit(){
        return $this->belongsTo(BettingLimit::class,"created_by","user_id");
    }

    public function children(){
        return $this->hasMany(self::class, 'created_by');
    }

    public function grandchildren()
    {
        return $this->children()->with('grandchildren');
    }
}
