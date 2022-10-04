<?php

namespace App\Http\Livewire\Suporte;

use Livewire\Component;
use \App\Models\ContatoMensagem;

class ModalMensagem extends Component
{
    public $mensagem;

    protected $listeners = ["carregaModalMensagemSuporte", "resetaModalMensagemSuporte"];

    public function carregaModalMensagemSuporte(ContatoMensagem $mensagem){
        $this->mensagem = $mensagem;
        $this->mensagem->visualizada = true;
        $this->mensagem->save();
        $this->dispatchBrowserEvent('abreModalMensagemSuporte');
        $this->emit('atualizaDatatableMensagens');
    }

    public function resetaModalMensagemSuporte(){
        $this->reset();
    }

    public function render()
    {
        return view('livewire.suporte.modal-mensagem');
    }
}
