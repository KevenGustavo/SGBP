<?php

namespace App\Http\Controllers;

use App\Models\Bem;
use App\Models\User;
use App\Models\Historico;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $cacheDuration = 900;

        $dashboardData = Cache::remember('dashboard.all_data', $cacheDuration, function () {
            $estados = array_merge(["Todos"], Bem::ESTADOS);
            $tiposUso = array_merge(["Todos"], Bem::TIPOS_USO);

            // --- DADOS PARA OS CARDS DE ESTATÍSTICAS (KPIs) ---
            $bemCount = Bem::count();
            $userCount = User::count();
            $bensManutencaoCount = Bem::where('estado', 'Em Manutenção')->count();

            // Contagem de transferências de responsabilidade e localização
            $transferenciasCount = Historico::where('tipo', '!=', 'Criação do Bem')->count();

            // --- DADOS PARA OS CARDS DE DISTRIBUIÇÃO ---
            $bensPorEstado = Bem::select('estado', DB::raw('count(*) as total'))
                ->groupBy('estado')
                ->orderBy('total', 'desc')
                ->get();

            $bensPorTipoUso = Bem::select('tipoUso', DB::raw('count(*) as total'))
                ->whereNotNull('tipoUso')->groupBy('tipoUso')
                ->orderBy('total', 'desc')->get();

            $rankingResponsaveis = Bem::with('user')
                ->select('responsavel_id', DB::raw('count(*) as total'))
                ->whereNotNull('responsavel_id')
                ->groupBy('responsavel_id')
                ->orderBy('total', 'desc')
                ->get();


            // --- DADOS PARA OS CARDS DE ATIVIDADE RECENTE ---
            $bensRecentes = Bem::with('user')
                ->latest()
                ->take(5)
                ->get();

            $ultimasTransferencias = Historico::with(['bem', 'responsavelAnterior', 'responsavelAtual', 'registrador'])
                ->whereNotNull('responsavel_anterior_id')
                ->latest()
                ->take(5)
                ->get();

            return [
                'bemCount' => $bemCount,
                'userCount' => $userCount,
                'bensManutencaoCount' => $bensManutencaoCount,
                'transferenciasCount' => $transferenciasCount,
                'bensPorEstado' => $bensPorEstado,
                'bensPorTipoUso' => $bensPorTipoUso,
                'rankingResponsaveis' => $rankingResponsaveis,
                'bensRecentes' => $bensRecentes,
                'ultimasTransferencias' => $ultimasTransferencias,
                'estados' => $estados,
                'tiposUso' => $tiposUso,
            ];
        });

        return view('dashboard.index', $dashboardData);
    }
}
