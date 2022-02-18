<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BettingLimit extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'min_limit',
        'max_limit'
    ];
}
