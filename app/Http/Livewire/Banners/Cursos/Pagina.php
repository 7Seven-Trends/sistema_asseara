<?php

namespace App\Http\Livewire\Banners\Cursos;

use Livewire\Component;
use App\Models\BannerCursos;
use Livewire\WithFileUploads;
use App\Classes\Util;
use Illuminate\Support\Facades\Storage;

class Pagina extends Component
{
    use WithFileUploads;

    public $arquivo;
    public $max;

    protected $listeners = ["atualizaLink"];

    public function atualizaLink(BannerCursos $banner, $link){
        $banner->link = $link;
        $banner->save();
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Link salvo com sucesso!']);
    }

    public function updatedArquivo(){
        $banner = new BannerCursos;
        $banner->caminho = asset($this->arquivo->store("images/banners", 'local'));
        $banner->ativo = true;
        $banner->posicao = $this->max + 1;
        $banner->save();
        $this->max = $banner->posicao;
        $this->arquivo = null;
        $this->emit('$refresh');
    }

    public function excluir(BannerCursos $banner){
        $banners = BannerCursos::where("posicao", "<", $banner->posicao)->get();
        Storage::delete(str_replace(url("/"), "", $banner->caminho));
        $banner->delete();

        foreach($banners as $banner){
            $banner->posicao -= 1;
            $banner->save();
        }

        $this->max = BannerCursos::max('posicao');
        $this->emit('$refresh');
    }

    public function sobePosicao(BannerCursos $banner){
        $banner_anterior = BannerCursos::where("posicao", $banner->posicao - 1)->first();
        $banner_anterior->posicao += 1;
        $banner->posicao -= 1;
        $banner_anterior->save();
        $banner->save();
        $this->emit('$refresh');
    }

    public function descePosicao(BannerCursos $banner){
        $banner_posterior = BannerCursos::where("posicao", $banner->posicao + 1)->first();
        $banner_posterior->posicao -= 1;
        $banner->posicao += 1;
        $banner_posterior->save();
        $banner->save();
        $this->emit('$refresh');
    }

    public function desativar(BannerCursos $banner){
        $banner->ativo = false;
        $banner->save();
        $this->emit('$refresh');
    }

    public function ativar(BannerCursos $banner){
        $banner->ativo = true;
        $banner->save();
        $this->emit('$refresh');
    }

    public function mount(){
        $this->max = BannerCursos::max('posicao');
    }

    public function render()
    {
        $banners = BannerCursos::orderBy("posicao", "ASC")->get();
        return view('livewire.banners.cursos.pagina', ['banners' => $banners]);
    }
}
