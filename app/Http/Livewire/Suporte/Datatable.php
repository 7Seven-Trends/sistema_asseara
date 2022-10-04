<?php

namespace App\Http\Livewire\Suporte;

use Livewire\Component;
use App\Models\ContatoMensagem;
use Livewire\WithPagination;

class Datatable extends Component
{
    use WithPagination;

    protected $listeners = ["atualizaDatatableMensagens" => '$refresh'];

    public function render()
    {
        $mensagens = ContatoMensagem::orderBy("created_at")->paginate(20);
        return view('livewire.suporte.datatable', ['mensagens' => $mensagens]);
    }
}
