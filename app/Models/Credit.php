<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'parent_id',
        'points',
        'type',
        'net_points',
        'action_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function parent_user(){
        return $this->belongsTo(User::class,'parent_id');
    }
    
    public function action_user(){
        return $this->belongsTo(User::class,'action_id');
    }
}
