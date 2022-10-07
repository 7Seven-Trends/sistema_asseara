<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class EventosController extends Controller
{
    //
    public function consultar(){
        return view("eventos.consultar");
    }

    public function palestras(Evento $evento){
        return view("palestras.consultar", ['evento' => $evento]);
    }
}
