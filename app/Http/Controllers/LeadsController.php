<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeadsController extends Controller
{
    //
    public function consultar(){
        return view("leads.consultar");
    }
}
