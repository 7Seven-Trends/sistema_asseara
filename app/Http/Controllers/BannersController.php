<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BannersController extends Controller
{
    //
    public function consultar(){
        return view("banners.consultar");
    }
}
