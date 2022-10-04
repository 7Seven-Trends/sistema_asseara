<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Evento extends Model
{
    use HasFactory;

    protected static function boot(){
        parent::boot();

        static::deleting(function($evento){
            Storage::delete(str_replace(url("/"), "", $evento->banner));
            Storage::delete(str_replace(url("/"), "", $evento->thumbnail));
        });
    }
}
