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
}