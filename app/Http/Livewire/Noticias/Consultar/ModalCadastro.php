<?php

namespace App\Http\Livewire\Noticias\Consultar;

use Livewire\Component;
use App\Models\Noticia;
use App\Models\Tag;
use App\Classes\Util;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ModalCadastro extends Component
{

    public $noticia_id;
    public $titulo;
    public $autor;
    public $categoria;
    public $publicacao;
    public $fonte;
    public $tags;
    public $resumo;
    public $conteudo;
    public $preview;
    public $nova_thumb;
    public $tipo = '0';
    public $link;
    public $show_croppie = false;

    protected $listeners = ["abreModalEdicao", "abreModalCadastro"];

    public function updatedTipo(){
        if($this->tipo == 1){
            $this->dispatchBrowserEvent('hideSummernote');
        }else{
            $this->dispatchBrowserEvent('showSummernote');
        }
    }

    public function abreModalEdicao(Noticia $noticia)
    {
        $this->noticia_id = $noticia->id;
        $this->titulo = $noticia->titulo;
        $this->autor = $noticia->autor;
        $this->categoria = $noticia->categoria_id;
        $this->publicacao = $noticia->publicacao;
        $this->fonte = $noticia->fonte;
        $this->resumo = $noticia->resumo;
        $this->conteudo = $noticia->conteudo;
        $this->preview = $noticia->preview;
        $this->tipo = $noticia->tipo;
        $this->link = $noticia->link;
        $this->tags = $noticia->tags->pluck("id");
        if($this->tipo == 1){
            $this->dispatchBrowserEvent('hideSummernote');
        }else{
            $this->dispatchBrowserEvent('showSummernote');
        }
        $this->dispatchBrowserEvent("carregaTexto");
        $this->dispatchBrowserEvent("abreModalNoticias");
        $this->dispatchBrowserEvent("resetaCroppie");
    }

    public function abreModalCadastro()
    {
        $this->resetar();
        $this->dispatchBrowserEvent("resetaCroppie");
        $this->dispatchBrowserEvent("carregaTexto");
        $this->dispatchBrowserEvent("abreModalNoticias");
    }

    public function salvar()
    {
        if ($this->noticia_id) {
            $noticia = Noticia::find($this->noticia_id);
        } else {
            $noticia = new Noticia;
        }
        $noticia->titulo = $this->titulo;
        $noticia->slug = Str::slug($this->titulo);
        $noticia->autor = $this->autor;
        $noticia->usuario_id = session()->get("usuario")["id"];
        $noticia->categoria_id = $this->categoria;
        $noticia->publicacao = $this->publicacao;
        $noticia->fonte = $this->fonte;
        $noticia->resumo = $this->resumo;
        $noticia->tipo = $this->tipo;
        $noticia->link = $this->link;
        if($this->conteudo){
            $noticia->conteudo = Util::processa_editor(null, $this->conteudo, 'site/imagens/noticias/');
        }else{
            $noticia->conteudo = null;
        }
        if ($this->nova_thumb) {
            Storage::delete(str_replace(url("/"), "", $noticia->preview));
            $caminho = str_replace(URL::to('/'), "", $this->nova_thumb);
            $array_file = explode("/", $this->nova_thumb);
            $filename = array_pop($array_file);
            Storage::move($caminho, 'site/imagens/noticias/' . $filename);
            $noticia->preview = asset('site/imagens/noticias/' . $filename);
        }

        $noticia->save();

        $tags = [];
        foreach ($this->tags as $tag) {
            if (is_numeric($tag)) {
                $tags[] = $tag;
            } else {
                $nova_tag = new Tag;
                $nova_tag->nome = $tag;
                $nova_tag->save();
                $tags[] = $nova_tag->id;
                $this->dispatchBrowserEvent("addSelect2Option", ["id" => $nova_tag->id, "nome" => $nova_tag->nome]);
            }
        }

        $noticia->tags()->sync($tags);

        $this->resetar();
        $this->emit("atualizaDatatable");
        $this->dispatchBrowserEvent("fechaModalNoticias");
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Noticia salva com sucesso!!']);
    }

    public function resetar()
    {
        $this->noticia_id = null;
        $this->titulo = null;
        $this->autor = null;
        $this->categoria = null;
        $this->publicacao = null;
        $this->fonte = null;
        $this->tags = null;
        $this->resumo = null;
        $this->conteudo = null;
        $this->preview = null;
        $this->nova_thumb = null;
        $this->show_croppie = false;
    }

    public function render()
    {
        return view('livewire.noticias.consultar.modal-cadastro');
    }
}
