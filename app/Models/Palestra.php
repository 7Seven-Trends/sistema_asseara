<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palestra extends Model
{
    use HasFactory;

    public function evento(){
        return $this->belongsTo(Evento::class);
    }
}
