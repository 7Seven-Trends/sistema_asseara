<?php

namespace App\Http\Livewire\Convenios\Consultar;

use Livewire\Component;
use \App\Models\Convenio;
use Livewire\WithFileUploads;
use App\Classes\Util;
use Illuminate\Support\Facades\Storage;

class ModalCadastro extends Component
{
    use WithFileUploads;

    public $convenio;
    public $arquivo;
    public $etapa = 1;

    protected $listeners = ["carregaModalCadastroConvenio", "carregaModalEdicaoConvenio", "resetaModalCadastroConvenio"];
    protected $rules = [
        "convenio.nome" => "",
        "convenio.link" => "",
        "arquivo" => "",
    ];

    public function carregaModalCadastroConvenio(){
        $this->convenio = new Convenio;
        $this->dispatchBrowserEvent("abreModalCadastroConvenio");
    }

    public function carregaModalEdicaoConvenio($id){
        $this->convenio = Convenio::find($id);
        $this->dispatchBrowserEvent("abreModalCadastroConvenio");
    }

    public function resetaModalCadastroConvenio(){
        $this->reset();
    }

    public function salvar(){
        if($this->arquivo){
            Storage::delete(str_replace(url("/"), "", $this->convenio->imagem));
            $this->convenio->imagem = asset($this->arquivo->store("imagems/convenios/", 'local'));
        }
        $this->arquivo = null;
        $this->convenio->save();
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Informações salvas com sucesso!']);
        $this->emit("atualizaDatatableConvenios");
        $this->dispatchBrowserEvent("fechaModalCadastroConvenio");
    }

    public function render()
    {
        return view('livewire.convenios.consultar.modal-cadastro');
    }
}
