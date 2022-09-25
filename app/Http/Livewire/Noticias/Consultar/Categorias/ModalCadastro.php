<?php

namespace App\Http\Livewire\Noticias\Consultar\Categorias;

use Livewire\Component;
use App\Models\Categoria;
use Illuminate\Support\Str;

class ModalCadastro extends Component
{

    public $nome;
    public $categoria_id;

    protected $listeners = ["abreModalCadastroCategoria", "abreModalEdicaoCategoria"];

    public function abreModalEdicaoCategoria(Categoria $categoria){
        $this->nome = $categoria->nome; 
        $this->categoria_id = $categoria->id;
        $this->dispatchBrowserEvent("abreModalCategorias");  
    }

    public function abreModalCadastroCategoria(){
        $this->resetar();  
        $this->dispatchBrowserEvent("abreModalCategorias");  
    }

    public function salvar(){
        if($this->categoria_id){
            $categoria = Categoria::find($this->categoria_id);
            $edicao = true;
        }else{
            $categoria = new Categoria;
            $edicao = false;
        }
        $categoria->nome = $this->nome;
        $categoria->slug = Str::slug($this->nome);
        $categoria->save();
        $this->resetar();
        $this->emit("atualizaDatatable");
        $this->dispatchBrowserEvent("fechaModalCategorias");
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Categoria salva com sucesso!!']);
        if($edicao){
            $this->dispatchBrowserEvent("editSelect2OptionCategoria", ["id" => $categoria->id, "nome" => $categoria->nome]);
        }else{
            $this->dispatchBrowserEvent("addSelect2OptionCategoria", ["id" => $categoria->id, "nome" => $categoria->nome]);
        }
    }

    public function resetar(){
        $this->nome = null;
        $this->categoria_id = null;
    }

    public function render()
    {
        return view('livewire.noticias.consultar.categorias.modal-cadastro');
    }
}
