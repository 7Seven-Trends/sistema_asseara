<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\AssociadosImport;
use App\Exports\AssociadosExport;
use Maatwebsite\Excel\Facades\Excel;

class AssociadosController extends Controller
{
    //

    public function consultar(){
        return view("associados.consultar");
    }

    public function importar(){
        $caminho = "imports/associados.xlsx";
        Excel::import(new AssociadosImport, $caminho);
        return redirect()->back();
    }

    public function exportar(){
        return Excel::download(new AssociadosExport, "associados.xlsx");
        // return redirect()->back();
    }
}
