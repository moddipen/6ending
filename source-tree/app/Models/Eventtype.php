<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matchtypeevent;

class Eventtype extends Model
{
    use HasFactory;
    public function matchtypeevents(){
        return $this->hasMany(Matchtypeevent::class);
    }
}
