<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchtypeeventResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'result',
        'matchtypeevent_id'
    ];
}
