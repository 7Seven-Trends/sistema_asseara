<?php

namespace App\Http\Livewire\Noticias\Consultar;

use Livewire\Component;
use App\Models\Noticia;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use App\Models\Categoria;
use Livewire\WithFileUploads;
use App\Classes\Util;

class Datatable extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $filtros;
    public $filtro_titulo;
    public $filtro_categoria;
    public $filtro_autor;
    public $filtro_publicacao_inicio;
    public $filtro_publicacao_fim;
    public $thumbs = [];
    public $banners = [];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ["atualizaDatatable" => '$refresh'];

    public function updatedThumbs($value, $key){
        $noticia = Noticia::find($key);
        if($this->thumbs[$key]){
            Storage::delete($noticia->preview);
            $noticia->preview = asset($this->thumbs[$key]->store('images/noticias/', 'local'));
            Util::limparLivewireTemp();
        }
        $noticia->save();
        $this->thumbs = [];
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Imagem atualizada com sucesso!']);
    }

    public function updatedBanners($value, $key){
        $noticia = Noticia::find($key);
        if($this->banners[$key]){
            Storage::delete($noticia->preview);
            $noticia->banner = asset($this->banners[$key]->store('images/noticias/', 'local'));
            Util::limparLivewireTemp();
        }
        $noticia->save();
        $this->banners = [];
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Imagem atualizada com sucesso!']);
    }

    public function excluirNoticia(Noticia $noticia){
        Storage::delete(str_replace(url("/"), "", $noticia->preview));
        $noticia->delete();
        $this->emit("atualizaDatatable");
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Noticia removida com sucesso!!']);
    }

    public function excluirCategoria(Categoria $categoria){
        if($categoria->noticias->count() > 0){
            $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'error', 'mensagem' => 'Essa categoria possui notícias ligadas a ela']);
        }else{
            $categoria->delete();
            $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Categoria removida com sucesso!!']);
            $this->emit("atualizaDatatable");
        }
    }

    public function publicar(Noticia $noticia){
        $noticia->publicada = !$noticia->publicada;
        $noticia->save();
        $this->emit("atualizaDatatable");
    }

    public function setFiltros(){
        $this->filtros = [];
        if($this->filtro_titulo){
            $this->filtros[] = ["titulo", "LIKE", "%$this->filtro_titulo%"];
        }
        if($this->filtro_autor){
            $this->filtros[] = ["autor", "LIKE", "%$this->filtro_autor%"];
        }
        if($this->filtro_categoria && $this->filtro_categoria != -1){
            $this->filtros[] = ["categoria_id", "=", "$this->filtro_categoria"];
        }
        if($this->filtro_publicacao_inicio){
            $this->filtros[] = ["publicacao", ">=", "$this->filtro_publicacao_inicio"];
        }
        if($this->filtro_publicacao_fim){
            $this->filtros[] = ["publicacao", "<=", "$this->filtro_publicacao_fim"];
        }
    }

    public function limpaFiltros(){
        $this->filtros = null;
        $this->filtro_titulo = null;
        $this->filtro_categoria = null;
        $this->filtro_publicacao_inicio = null;
        $this->filtro_publicacao_fim = null;
        $this->filtro_autor = null;
    }

    public function render()
    {
        if($this->filtros){
            $noticias = Noticia::where($this->filtros)->paginate(10);
        }else{
            $noticias = Noticia::paginate(10);
        }
        return view('livewire.noticias.consultar.datatable', ["noticias" => $noticias]);
    }
}
