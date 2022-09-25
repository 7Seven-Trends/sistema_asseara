<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Visitas;

class PainelController extends Controller
{

    public function index()
    {
        return view("index");
    }
    
    public function login()
    {
        return view("login");
    }

    public function logar(Request $request)
    {
        $usuario = Usuario::where("usuario", $request->usuario)->first();
        if ($usuario) {
            if (!$usuario->ativo) {
                Log::channel('acessos')->info('LOGIN: O usuario bloqueado ' . $usuario->usuario . ' tentou logar no sistema.');
                toastr()->error("O seu usuário está bloqueado no sistema!");
                return redirect()->route("painel.index");
            }
            if (Hash::check($request->senha, $usuario->senha)) {
                session()->put(["usuario" => $usuario->toArray()]);
                Log::channel('acessos')->info('LOGIN: O usuario ' . $usuario->usuario . ' logou no sistema.');
                return redirect()->route("painel.index");
            } else {
                toastr()->error("Informações de usuário incorretas!");
                session()->flash("erro", "Informações de usuário incorretas!");
            }
        } else {
            toastr()->error("Informações de usuário incorretas!");
            session()->flash("erro", "Informações de usuário incorretas!");
        }

        return redirect()->back();
    }

    public function sair()
    {
        Log::channel('acessos')->info('LOGIN: O usuario ' . session()->get("usuario")["usuario"] . ' saiu do sistema.');
        session()->forget("usuario");
        return redirect()->route("painel.login");
    }

    public function leads()
    {
        $visitas = Visitas::orderBy("created_at", "DESC")->get();
        return view("leads", ['visitas' => $visitas]);
    }

}
