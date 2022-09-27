<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Associado extends Model
{
    protected $guarded = ["id"];
    use HasFactory;

    public function contratos(){
        return $this->hasMany(AssociadoContrato::class);
    }

    public function contrato_ativo(){
        return $this->hasOne(AssociadoContrato::class)->where("ativo", true);
    }
}
