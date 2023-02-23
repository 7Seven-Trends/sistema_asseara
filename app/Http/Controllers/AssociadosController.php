<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\AssociadosImport;
use App\Exports\AssociadosExport;
use App\Models\Associado;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AssociadosController extends Controller
{
	//

	public function consultar()
	{
		return view("associados.consultar");
	}

	public function senhas()
	{
		$associados = Associado::where('senha', null)->get();

		foreach ($associados as $associado) {
			$associado->senha = Hash::make(substr($associado->cpf, 0, -9));
			$associado->save();
		}

		return redirect()->back();
	}

	public function importar()
	{
		$caminho = "imports/associados.xlsx";
		Excel::import(new AssociadosImport, $caminho);
		return redirect()->back();
	}

	public function exportar()
	{
		return Excel::download(new AssociadosExport, "associados.xlsx");
		// return redirect()->back();
	}
}
