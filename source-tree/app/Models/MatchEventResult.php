<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchEventResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'result',
        'match_event_id'
    ];
}
