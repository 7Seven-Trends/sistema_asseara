<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    //
    public function consultar(){
        return view("newsletter.consultar");
    }
}
