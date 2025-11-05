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
        // Coletar métricas básicas para dashboard
        $totalAssociados = \App\Models\Associado::count();
        $totalLeads = \App\Models\Leads::count();
        $totalUsuarios = \App\Models\Usuario::count();

        // Dados para gráficos
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $months[] = now()->subMonths($i)->format('Y-m');
        }

        // Associados por mês (últimos 6 meses)
        $associadosPorMes = \App\Models\Associado::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, count(*) as total")
            ->whereIn(\DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), $months)
            ->groupBy('ym')
            ->pluck('total', 'ym')
            ->toArray();

        // Leads por mês (últimos 6 meses)
        $leadsPorMes = \App\Models\Leads::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, count(*) as total")
            ->whereIn(\DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), $months)
            ->groupBy('ym')
            ->pluck('total', 'ym')
            ->toArray();

        // Usuários ativos vs inativos (assume coluna 'ativo' existe)
        $ativos = \App\Models\Usuario::where('ativo', true)->count();
        $inativos = \App\Models\Usuario::where('ativo', false)->count();

        // preparar arrays ordenados para os meses
        $associadosData = [];
        $leadsData = [];
        foreach ($months as $m) {
            $associadosData[] = isset($associadosPorMes[$m]) ? (int) $associadosPorMes[$m] : 0;
            $leadsData[] = isset($leadsPorMes[$m]) ? (int) $leadsPorMes[$m] : 0;
        }

        return view("index", compact(
            'totalAssociados',
            'totalLeads',
            'totalUsuarios',
            'months',
            'associadosData',
            'leadsData',
            'ativos',
            'inativos'
        ));
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
