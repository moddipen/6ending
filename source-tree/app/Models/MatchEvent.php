<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'match_id',
        'matchtypeevent_id',
        'status',
        'is_settled'
    ];

    public function matchtypeevent(){
        return $this->belongsTo(Matchtypeevent::class);
    }
    
    public function match(){
        return $this->belongsTo(Match::class);
    }

    public function match_result(){
        return $this->hasOne(MatchEventResult::class);
    }  
    
    public function bet(){
        return $this->hasMany(Bet::class);
    }

    public function loss_bet(){
        return $this->hasMany(Bet::class)->where("status","loss");//->selectRaw('SUM(bet_coins) as total_loss');
    }

    public function won_bet(){
        return $this->hasMany(Bet::class)->where("status","win");//->selectRaw('SUM(bet_coins) as total_profit');
    }

    public function bett(){
        return $this->hasOne(Bet::class);
    }

    public function settlement(){
        return $this->hasMany(MatchEventSettlement::class);
    }
}