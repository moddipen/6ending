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
        'status',
        'schedule'
    ];

    public function matchtype(){
        return $this->belongsTo(Matchtype::class,'matchtype_id');
    }
}