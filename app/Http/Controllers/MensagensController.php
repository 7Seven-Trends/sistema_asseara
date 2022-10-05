<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MensagensController extends Controller
{
    //
    public function suporte(){
        return view("contatos.suporte");
    }
}
