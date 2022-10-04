<?php

namespace App\Models;

use App\Traits\ConvenioTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Convenio extends Model
{

    protected static function boot(){
        parent::boot();

        static::deleting(function($convenio){
            Storage::delete(str_replace(url("/"), "", $convenio->imagem));
        });
    }

}
