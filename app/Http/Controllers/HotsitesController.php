<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotsitesController extends Controller
{
    public function consultar(){
        return view("hotsites.consultar");
    }
}
