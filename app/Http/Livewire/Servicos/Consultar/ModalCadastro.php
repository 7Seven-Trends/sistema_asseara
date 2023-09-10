<?php

namespace App\Http\Livewire\Servicos\Consultar;

use Livewire\Component;
use App\Models\Servicos;

class ModalCadastro extends Component
{
    public $servico;

    protected $listeners = ["carregaModalCadastroServicos", "carregaModalEdicaoServicos", "resetaModalCadastroServicos"];
    protected $rules = [
        "servico.nome" => "",
        "servico.conteudo" => "",
        "servico.ativo" => true,
    ];

    public function carregaModalCadastroServicos(){
		$this->servico = new Servicos;
		$this->servico->ativo = true;
        $this->dispatchBrowserEvent("abreModalCadastroServicos");
    }

    public function carregaModalEdicaoServicos($id){
        $this->servico = Servicos::find($id);
        $this->dispatchBrowserEvent("abreModalCadastroServicos");
    }

    public function resetaModalCadastroServicos(){
        $this->reset();
    }

    public function salvar(){
        $this->servico->save();
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Informações salvas com sucesso!']);
        $this->emit("atualizaDatatableServicos");
        $this->dispatchBrowserEvent("fechaModalCadastroServicos");
    }

    public function render()
    {
        return view('livewire.servicos.consultar.modal-cadastro');
    }
}
