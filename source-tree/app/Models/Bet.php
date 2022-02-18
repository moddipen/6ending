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

    public function credit(){
        return $this->hasOne(Credit::class,'user_id','user_id')->latest('id');
    }

    public function match_event(){
        return $this->belongsTo(MatchEvent::class);
    }

    public function settlement(){
        return $this->belongsTo(MatchEventSettlement::class,"match_event_id","match_event_id");
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
