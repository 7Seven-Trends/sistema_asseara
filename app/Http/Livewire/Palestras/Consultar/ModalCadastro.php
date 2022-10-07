<?php

namespace App\Http\Livewire\Palestras\Consultar;

use Livewire\Component;
use App\Models\Palestra;
use App\Classes\Util;

class ModalCadastro extends Component
{
    public $evento_id;
    public $palestra;

    protected $listeners = ["carregaModalCadastroPalestra", "carregaModalEdicaoPalestra", "resetaModalCadastroPalestra"];
    protected $rules = [
        "palestra.evento_id" => "",
        "palestra.titulo" => "",
        "palestra.data" => "",
        "palestra.horario" => "",
        "palestra.palestrante" => "",
        "palestra.conteudo" => ""
    ];

    public function carregaModalCadastroPalestra(){
        $this->palestra = new Palestra;
        $this->dispatchBrowserEvent("abreModalCadastroPalestra");
    }

    public function carregaModalEdicaoPalestra($id){
        $this->palestra = Palestra::find($id);
        $this->dispatchBrowserEvent("carregaTexto");
        $this->dispatchBrowserEvent("abreModalCadastroPalestra");
    }

    public function resetaModalCadastroPalestra(){
        $this->resetExcept('evento_id');
    }

    public function salvar(){
        $this->palestra->evento_id = $this->evento_id;
        $this->palestra->conteudo = Util::processa_editor($this->palestra->id, $this->palestra->conteudo, 'site/images/palestras/');
        $this->palestra->save();
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Informações salvas com sucesso!']);
        $this->emit("atualizaDatatablePalestras");
        $this->dispatchBrowserEvent("fechaModalCadastroPalestra");
    }

    public function mount($evento_id){
        $this->evento_id = $evento_id;
    }

    public function render()
    {
        return view('livewire.palestras.consultar.modal-cadastro');
    }
}
