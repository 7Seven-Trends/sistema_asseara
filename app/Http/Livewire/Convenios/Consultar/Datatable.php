<?php

namespace App\Http\Livewire\Convenios\Consultar;

use Livewire\Component;
use App\Models\Convenio;
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
    protected $listeners = ["atualizaDatatableConvenios" => '$refresh'];

    public function updatedArquivos($value, $key){
        $convenio = Convenio::find($key);
        if($this->arquivos[$key]){
            Storage::delete($convenio->imagem);
            $convenio->imagem = asset($this->arquivos[$key]->store('images/convenios/', 'local'));
            Util::limparLivewireTemp();
        }
        $convenio->save();
        $this->arquivos = [];
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Imagem atualizada com sucesso!']);
    }

    public function excluir(Convenio $convenio){
        $convenio->delete();
        $this->emit('$refresh');
    }

    public function render()
    {
        $convenios = Convenio::orderBy("created_at", "DESC")->paginate(20);
        return view('livewire.convenios.consultar.datatable', ['convenios' => $convenios]);
    }
}
