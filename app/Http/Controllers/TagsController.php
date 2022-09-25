<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;

class TagsController extends Controller
{
    //
    public function consultar(){
        $tags = Tag::all();
        return view("painel.tags.consultar", ["tags" => $tags]);
    }

    public function cadastrar(Request $request){
        $request->validate([
            'nome' => 'unique:tags,nome',
        ]);

        $tag = new Tag;
        $tag->nome = $request->nome;
        $tag->save();

        Log::channel('tags')->info('<b>CADASTRANDO TAG</b>: O usuario <b>' . session()->get("usuario")["usuario"] . '</b> cadastrou a hashtag <b>' . $tag->nome . '</b>');

        toastr()->success("Tag salva com sucesso!");
        return redirect()->back();
    }

    public function salvar(Request $request, Tag $tag){
        $request->validate([
            'nome' => 'unique:tags,nome,'.$tag->id,
        ]);

        $old = $tag->getOriginal();

        $tag->nome = $request->nome;
        $tag->save();

        foreach($tag->getChanges() as $campo => $valor){
            if(!in_array($campo, ["updated_at", "slug"])){
                Log::channel('tags')->info('<b>EDITANDO TAG #'.$tag->id.'</b>: O usuario <b>' . session()->get("usuario")["usuario"] . '</b> alterou o valor do campo <b>' . $campo . '</b> de <b>' . $old[$campo] . '</b> para <b>' . $valor . '</b>');
            }
        }

        toastr()->success("Tag salva com sucesso!");
        return redirect()->back();
    }

    public function deletar(Tag $tag){
        $tag->delete();
        toastr()->success("Tag removida com sucesso!");
        return redirect()->back();
    }
}
