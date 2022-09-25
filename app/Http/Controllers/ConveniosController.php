<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConveniosController extends Controller
{
    //
    public function consultar(){
        return view("convenios.consultar");
    }
}
