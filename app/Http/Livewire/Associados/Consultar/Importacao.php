<?php

namespace App\Http\Livewire\Associados\Consultar;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\AssociadosImport;
use Maatwebsite\Excel\Facades\Excel;


class Importacao extends Component
{
	use WithFileUploads;
	public $arquivo;

	public $listeners = ['abreModalImportacao', 'fechaModalImportacao'];

	public function importar()
	{
		// dd($this->arquivo);
		Excel::import(new AssociadosImport, $this->arquivo);
		$this->fechaModalImportacao();
		$this->emit('atualizaDatatableAssociados');
	}

	public function abreModalImportacao()
	{
		$this->dispatchBrowserEvent("abreModalImportacao");
	}

	public function fechaModalImportacao()
	{
		$this->dispatchBrowserEvent("fechaModalImportacao");
	}
	public function render()
	{
		return view('livewire.associados.consultar.importacao');
	}
}
