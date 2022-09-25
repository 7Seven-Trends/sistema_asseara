<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagensController extends Controller
{
    //

    public function salvar_temp(Request $request){
        $data = $request->image;
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $type = explode("/", $type)[1];
        $data = base64_decode($data);
        $imageName = time().'.'.$type;
        file_put_contents('site/imagens/temp/'.$imageName, $data);
        $caminho = asset('site/imagens/temp/'.$imageName);
        return response()->json($caminho);
    }
}
