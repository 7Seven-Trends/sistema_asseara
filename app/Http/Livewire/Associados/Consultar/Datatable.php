<?php

namespace App\Http\Livewire\Associados\Consultar;

use Livewire\Component;
use App\Models\Associado;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Classes\Util;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Datatable extends Component
{
	use WithPagination;
	use WithFileUploads;

	public $arquivos = [];

	protected $paginationTheme = "bootstrap";
	protected $listeners = ["atualizaDatatableAssociados" => '$refresh', 'atualizaValorAssociado'];

	public function updatedArquivos($value, $key)
	{
		$associado = Associado::find($key);
		if ($this->arquivos[$key]) {
			Storage::delete($associado->foto);
			$associado->foto = asset($this->arquivos[$key]->store('images/associados/', 'local'));
			Util::limparLivewireTemp();
		}
		$associado->save();
		$this->arquivos = [];
		$this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Imagem atualizada com sucesso!']);
	}

	public function atualizaValorAssociado($id, $campo, $valor)
	{
		$associado = Associado::find($id);
		$associado->$campo = $valor;
		$associado->save();
		$this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Informação salva com sucesso!']);
	}

	public function excluir(Associado $associado)
	{
		$associado->delete();
		$this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Associado removido com sucesso!']);
		$this->emit('$refresh');
	}

	public function render()
	{
		$associados = Associado::orderBy("created_at", "DESC")->paginate(20);
		return view('livewire.associados.consultar.datatable', ["associados" => $associados]);
	}
}
