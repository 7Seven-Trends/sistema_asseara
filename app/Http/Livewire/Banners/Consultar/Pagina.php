<?php

namespace App\Http\Livewire\Banners\Consultar;

use Livewire\Component;
use App\Models\Banner;
use Livewire\WithFileUploads;
use App\Classes\Util;
use Illuminate\Support\Facades\Storage;

class Pagina extends Component
{
    use WithFileUploads;

    public $arquivo;
    public $max;

    public function updatedArquivo(){
        $banner = new Banner;
        $banner->caminho = asset($this->arquivo->store("images/banners", 'local'));
        $banner->ativo = true;
        $banner->posicao = $this->max + 1;
        $banner->save();
        $this->max = $banner->posicao;
        $this->arquivo = null;
        $this->emit('$refresh');
    }

    public function excluir(Banner $banner){
        $banners = Banner::where("posicao", "<", $banner->posicao)->get();
        Storage::delete(str_replace(url("/"), "", $banner->caminho));
        $banner->delete();

        foreach($banners as $banner){
            $banner->posicao -= 1;
            $banner->save();
        }

        $this->max = Banner::max('posicao');
        $this->emit('$refresh');
    }

    public function sobePosicao(Banner $banner){
        $banner_anterior = Banner::where("posicao", $banner->posicao - 1)->first();
        $banner_anterior->posicao += 1;
        $banner->posicao -= 1;
        $banner_anterior->save();
        $banner->save();
        $this->emit('$refresh');
    }

    public function descePosicao(Banner $banner){
        $banner_posterior = Banner::where("posicao", $banner->posicao + 1)->first();
        $banner_posterior->posicao -= 1;
        $banner->posicao += 1;
        $banner_posterior->save();
        $banner->save();
        $this->emit('$refresh');
    }

    public function desativar(Banner $banner){
        $banner->ativo = false;
        $banner->save();
        $this->emit('$refresh');
    }

    public function ativar(Banner $banner){
        $banner->ativo = true;
        $banner->save();
        $this->emit('$refresh');
    }
    
    public function mount(){
        $this->max = Banner::max('posicao');
    }

    public function render()
    {
        $banners = Banner::orderBy("posicao", "ASC")->get();
        return view('livewire.banners.consultar.pagina', ['banners' => $banners]);
    }
}
