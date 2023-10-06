<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function leadAdd(Request $request)
    {

        return response()->json([
            'code' => 200,
            'return' => true,
            'msg' => 'Lead inserido com sucesso!',
        ]);
    }
}
