<?php

namespace App\Exports;

use App\Models\Associado;
use Maatwebsite\Excel\Concerns\FromCollection;

class AssociadosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Associado::select("id", "nome", "cpf", "registro_profissional")->get();
    }
}
