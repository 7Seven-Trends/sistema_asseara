<?php

namespace App\Http\Livewire\Associados\Consultar;

use Livewire\Component;
use App\Models\Associado;

class ModalCadastro extends Component
{
    public $associado;
    public $etapa = 1;
    public $nova_senha;
    
    protected $listeners = ["carregaModalCadastroAssociado", "carregaModalEdicaoAssociado", "resetaModalCadastroAssociado"];
    protected $rules = [
        "associado.nome" => "",
        "associado.email" => "",
		"associado.senha" => "",

        "associado.modalidade" => "",
        "associado.cpf" => "",
        "associado.telefone" => "",
        "associado.nascimento" => "",
        "associado.registro_profissional" => "",
        "associado.conselho_profissional" => "",
        "associado.titulo_profissional" => "",
        "associado.atribuicoes" => "",
        "associado.endereco_atendimento" => "",
        "associado.cidade_atendimento" => "",
        "associado.uf_atendimento" => "",
        "associado.cep_atendimento" => "",
    ];

    public function carregaModalCadastroAssociado(){
        $this->associado = new Associado;
        $this->dispatchBrowserEvent("abreModalCadastroAssociado");
    }

    public function carregaModalEdicaoAssociado($id){
        $this->associado = Associado::find($id);
        $this->dispatchBrowserEvent("abreModalCadastroAssociado");
    }

    public function resetaModalCadastroAssociado(){
        $this->reset();
    }

    public function salvar(){
        if($this->nova_senha){
            $this->associado->senha = $this->nova_senha;
        }
        $this->associado->save();
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Informações salvas com sucesso!']);
        $this->emit("atualizaDatatableAssociados");
        $this->dispatchBrowserEvent("fechaModalCadastroAssociado");
        
    }

    public function render()
    {
        return view('livewire.associados.consultar.modal-cadastro');
    }
}
