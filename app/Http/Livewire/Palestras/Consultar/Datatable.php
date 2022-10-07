<?php

namespace App\Http\Livewire\Palestras\Consultar;

use Livewire\Component;
use App\Models\Evento;
use App\Models\Palestra;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Classes\Util;

class Datatable extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $evento;
    public $thumbnails = [];
    public $banners = [];

    protected $paginationTheme = "bootstrap";
    protected $listeners = ["atualizaDatatablePalestras" => '$refresh', 'atualizaValorPalestra'];

    public function updatedThumbnails($value, $key){
        $palestra = Palestra::find($key);
        if($this->thumbnails[$key]){
            Storage::delete($palestra->thumbnail);
            $palestra->thumbnail = asset($this->thumbnails[$key]->store('images/palestras/', 'local'));
            Util::limparLivewireTemp();
        }
        $palestra->save();
        $this->thumbnails = [];
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Imagem atualizada com sucesso!']);
    }

    public function updatedBanners($value, $key){
        $palestra = Palestra::find($key);
        if($this->banners[$key]){
            Storage::delete($palestra->banner);
            $palestra->banner = asset($this->banners[$key]->store('images/palestras/', 'local'));
            Util::limparLivewireTemp();
        }
        $palestra->save();
        $this->banners = [];
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Imagem atualizada com sucesso!']);
    }

    public function atualizaValorPalestra($id, $campo, $valor){
        $Palestra = Palestra::find($id);
        $Palestra->$campo = $valor;
        $Palestra->save();
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Informação salva com sucesso!']);
    }

    public function excluir(Palestra $palestra){
        $palestra->delete();
        $this->emit('$refresh');
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Palestra removida com sucesso!']);
    }

    public function mount(Evento $evento){
        $this->evento = $evento;
    }

    public function render()
    {
        $palestras = Palestra::where("evento_id", $this->evento->id)->orderBy("created_at", "DESC")->paginate(20);
        return view('livewire.palestras.consultar.datatable', ['palestras' => $palestras]);
    }
}
