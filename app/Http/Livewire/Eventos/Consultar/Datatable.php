<?php

namespace App\Http\Livewire\Eventos\Consultar;

use Livewire\Component;
use App\Models\Evento;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Classes\Util;

class Datatable extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $thumbnails = [];
    public $banners = [];

    protected $paginationTheme = "bootstrap";
    protected $listeners = ["atualizaDatatableEventos" => '$refresh', 'atualizaValorEvento'];

    public function updatedThumbnails($value, $key){
        $evento = Evento::find($key);
        if($this->thumbnails[$key]){
            Storage::delete($evento->thumbnail);
            $evento->thumbnail = asset($this->thumbnails[$key]->store('images/eventos/', 'local'));
            Util::limparLivewireTemp();
        }
        $evento->save();
        $this->thumbnails = [];
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Imagem atualizada com sucesso!']);
    }

    public function updatedBanners($value, $key){
        $evento = Evento::find($key);
        if($this->banners[$key]){
            Storage::delete($evento->banner);
            $evento->banner = asset($this->banners[$key]->store('images/eventos/', 'local'));
            Util::limparLivewireTemp();
        }
        $evento->save();
        $this->banners = [];
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Imagem atualizada com sucesso!']);
    }

    public function atualizaValorEvento($id, $campo, $valor){
        $evento = Evento::find($id);
        $evento->$campo = $valor;
        $evento->save();
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Informação salva com sucesso!']);
    }

    public function render()
    {
        $eventos = Evento::orderBy("created_at", "DESC")->paginate(20);
        return view('livewire.eventos.consultar.datatable', ["eventos" => $eventos]);
    }
}
