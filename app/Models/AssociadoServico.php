<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociadoServico extends Model
{
    use HasFactory;



    public function associado(){
        return $this->belongsTo(Associado::class);
    }

}
