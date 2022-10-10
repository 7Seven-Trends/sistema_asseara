<?php

namespace App\Http\Livewire\Eventos\Consultar;

use Livewire\Component;
use App\Models\Evento;
use App\Classes\Util;

class ModalCadastro extends Component
{
    public $evento;

    protected $listeners = ["carregaModalCadastroEvento", "carregaModalEdicaoEvento", "resetaModalCadastroEvento"];
    protected $rules = [
        "evento.titulo" => "",
        "evento.data" => "",
        "evento.horario" => "",
        "evento.local" => "",
        "evento.tema" => "",
        "evento.palestrante" => "",
        "evento.conteudo" => "",
        "evento.data" => "",
        "evento.utiliza_palestras" => ""
    ];

    public function carregaModalCadastroEvento(){
        $this->evento = new Evento;
        $this->dispatchBrowserEvent("abreModalCadastroEvento");
    }

    public function carregaModalEdicaoEvento($id){
        $this->evento = Evento::find($id);
        $this->dispatchBrowserEvent("carregaTexto");
        $this->dispatchBrowserEvent("abreModalCadastroEvento");
    }

    public function resetaModalCadastroEvento(){
        $this->reset();
    }

    public function salvar(){
        $this->evento->conteudo = Util::processa_editor($this->evento->id, $this->evento->conteudo, 'site/images/eventos/');
        if($this->evento->utiliza_palestras === null){
            $this->evento->utiliza_palestras = 0;
        }
        $this->evento->save();
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Informações salvas com sucesso!']);
        $this->emit("atualizaDatatableEventos");
        $this->dispatchBrowserEvent("fechaModalCadastroEvento");
    }

    public function render()
    {
        return view('livewire.eventos.consultar.modal-cadastro');
    }
}
