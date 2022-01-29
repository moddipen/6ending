<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;
    protected $fillable = [
        'matchtype_id',
        'team_1',
        'team_2',
        'shortcode_1',
        'shortcode_2',
        'status',
        'schedule',
        'is_settled'
    ];

    public function matchtype(){
        return $this->belongsTo(Matchtype::class,'matchtype_id');
    }

    public function matchtypeevent(){
        return $this->belongsTo(Matchtype::class,'matchtype_id');
    }

    public function bets(){
        return $this->hasMany(Bet::class,'match_id');
    }

    public function events(){
        return $this->hasMany(MatchEvent::class,'match_id');
    }
}