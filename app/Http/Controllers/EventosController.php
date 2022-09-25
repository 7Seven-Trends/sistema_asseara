<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventosController extends Controller
{
    //
    public function consultar(){
        return view("eventos.consultar");
    }
}
