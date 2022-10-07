<?php

namespace App\Exports;

use App\Models\Associado;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AssociadosExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.associados', [
            'associados' => Associado::all()
        ]);
        // return Associado::select("id", "nome", "cpf", "registro_profissional")->get();
    }
}
