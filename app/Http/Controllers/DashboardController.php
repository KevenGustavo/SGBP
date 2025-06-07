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

            // --- DADOS PARA OS CARDS DE ESTATÍSTICAS (KPIs) ---
            $bemCount = Bem::count();
            $userCount = User::count();
            $bensManutencaoCount = Bem::where('estado', 'Em Manutenção')->count();

            // Contagem de transferências de responsabilidade nos últimos 30 dias
            $transferenciasMesCount = Historico::whereNotNull('responsavel_anterior_id')
                ->where('created_at', '>=', now()->subDays(30))
                ->count();

            // --- DADOS PARA OS CARDS DE DISTRIBUIÇÃO ---

            $bensPorEstado = Bem::select('estado', DB::raw('count(*) as total'))
                ->groupBy('estado')
                ->orderBy('total', 'desc')
                ->get();

            $topResponsaveis = Bem::with('user')
                ->select('responsavel_id', DB::raw('count(*) as total'))
                ->groupBy('responsavel_id')
                ->orderBy('total', 'desc')
                ->take(5)
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
                'transferenciasMesCount' => $transferenciasMesCount,
                'bensPorEstado' => $bensPorEstado,
                'topResponsaveis' => $topResponsaveis,
                'bensRecentes' => $bensRecentes,
                'ultimasTransferencias' => $ultimasTransferencias,
            ];
        });

        return view('dashboard.index', $dashboardData);
    }
}
