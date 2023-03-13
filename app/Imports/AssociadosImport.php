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

		// dd($row);


		// $associado->nome = $row["nome"];
		// $associado->cpf = $row["cpf"];
		// $associado->registro_profissional = $row["registro_profissional"];

		if (
			!array_key_exists('nome', $row) ||
			!array_key_exists('cpf', $row) ||
			!array_key_exists('rnp', $row) ||
			!array_key_exists('email', $row) ||
			!array_key_exists('telefone', $row) ||
			!array_key_exists('endereco', $row) ||
			!array_key_exists('cidade', $row) ||
			!array_key_exists('uf', $row) ||
			!array_key_exists('pais', $row) ||
			!array_key_exists('inscrito_desde', $row) ||
			!array_key_exists('nascimento', $row) ||
			!array_key_exists('modalidade', $row) ||
			!array_key_exists('conselho', $row) ||
			!array_key_exists('titulo', $row) ||
			!array_key_exists('situacao', $row)
		) {
			dd('Atenção: Planilha fora dos padrões.');
			return;
		}

		// dd(date('Y-d-m H:i:s'));


		if ($row['cpf'] == "" || $row['situacao'] == "") {
			return;
		}

		$associado->nome = $row["nome"];
		$associado->cpf = $row["cpf"];
		$associado->registro_profissional = $row["rnp"];
		$associado->email = $row["email"];
		$associado->telefone = $row["telefone"];
		$associado->endereco_atendimento = $row["endereco"];
		$associado->cidade_atendimento = $row["cidade"];
		$associado->uf_atendimento = $row["uf"];
		$associado->cep_atendimento = $row["cep"];
		$associado->pais_atendimento = $row["pais"];


		if ($row['inscrito_desde'] !== "" && $row['inscrito_desde'] !== null) {
			$associado->created_at = date('Y-m-d H:i:s', strtotime($row["inscrito_desde"]));
		}

		if ($row['nascimento'] !== "" && $row['nascimento'] !== null) {
			$associado->nascimento = date('y-m-d', strtotime($row["nascimento"]));
		}


		$associado->modalidade = array_search($row["modalidade"], config("associados.modalidades"));
		$associado->conselho_profissional = array_search($row["conselho"], config("associados.conselhos"));
		$associado->titulo_profissional = array_search($row["titulo"], config("associados.titulis"));
		$associado->situacao = array_search($row["situacao"], config("associados.situacoes"));




		return $associado;
	}
}
