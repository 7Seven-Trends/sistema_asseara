<?php

namespace App\Imports;

use App\Models\Associado;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use App\Classes\Util;

class AssociadosImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $associado = new Associado;
        
        $associado->nome = $row["nome"];
        $associado->cpf = $row["cpf"];
        $associado->registro_profissional = $row["registro_profissional"];

        return $associado;
    }
}
