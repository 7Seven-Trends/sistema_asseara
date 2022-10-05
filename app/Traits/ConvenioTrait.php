<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ConvenioTrait {

    protected static function bootConvenioTrait(){
        static::deleating(function($model){
            Storage::delete(str_replace(url("/"), "", $model->imagem));
        });
    }
    
}