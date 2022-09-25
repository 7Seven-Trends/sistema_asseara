<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssociadosController extends Controller
{
    //

    public function consultar(){
        return view("associados.consultar");
    }
}
