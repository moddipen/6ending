<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eventtype;

class Matchtypeevent extends Model
{
    use HasFactory;
    protected $fillable = [
        'matchtype_id',
        'eventtype_id',
        'bet_coin',
        'win_coin'
    ];

    public function event_types(){
        return $this->belongsTo(Eventtype::class,'eventtype_id');
    }

    public function match_types(){
        return $this->belongsTo(Matchtype::class,'matchtype_id');
    }
}
