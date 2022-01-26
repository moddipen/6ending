<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'match_event_id',
        'bet_coins',
        'status',
        'result',
        'type'
    ];

    public function match(){
        return $this->belongsTo(Match::class);
    }
}
