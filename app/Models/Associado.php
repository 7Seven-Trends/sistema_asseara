<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Associado extends Model
{
    protected $guarded = ["id"];

    use HasFactory;
    use SoftDeletes;

    public function contratos(){
        return $this->hasMany(AssociadoContrato::class);
    }
    public function servicos(){
        return $this->hasMany(AssociadoServico::class);
    }
    public function contrato_ativo(){
        return $this->hasOne(AssociadoContrato::class)->where("ativo", true);
    }
    public function projetos(){
        return $this->hasMany(AssociadoProjeto::class);
    }
}
