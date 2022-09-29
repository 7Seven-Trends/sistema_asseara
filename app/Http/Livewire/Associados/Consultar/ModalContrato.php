<?php

namespace App\Http\Livewire\Associados\Consultar;

use Livewire\Component;
use App\Models\AssociadoContrato;

class ModalContrato extends Component
{
    public $associado;
    public $contrato;
    public $op;

    protected $listeners = ["carregaModalCadastroContrato", "carregaModalEdicaoContrato", "resetaModalContrato"];

    protected $rules = [
        "contrato.inicio" => "",
        "contrato.fim" => "",
        "contrato.associado_id" => "",
    ];

    public function carregaModalCadastroContrato($associado){
        $this->contrato = new AssociadoContrato;
        $this->contrato->associado_id = $associado;
        $this->op = 'cadastro';
        $this->dispatchBrowserEvent("abreModalContrato");
    }

    public function carregaModalEdicaoContrato(AssociadoContrato $contrato){
        $this->contrato = $contrato;
        $this->op = 'edição';
        $this->dispatchBrowserEvent("abreModalContrato");
    }

    public function salvar(){
        $this->contrato->save();
        $this->dispatchBrowserEvent("fechaModalContrato");
        $this->emit("atualizaDatatableAssociados");
    }

    public function cancelar(){
        $this->contrato->ativo = false;
        $this->contrato->save();
        $this->dispatchBrowserEvent("fechaModalContrato");
        $this->emit("atualizaDatatableAssociados");
    }

    public function resetaModalContrato(){
        $this->reset();
    }

    public function render()
    {
        return view('livewire.associados.consultar.modal-contrato');
    }
}
