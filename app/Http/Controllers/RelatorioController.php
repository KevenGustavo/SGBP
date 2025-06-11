<?php

namespace App\Http\Controllers;

use App\Models\Bem;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function gerarRelatorioBens()
    {
        Gate::authorize("viewAny", User::class);

        $todosBens = Bem::with('user')->orderBy('estado')->orderBy('patrimonio')->get();
        $bensAgrupados = $todosBens->groupBy('estado');
        $contagemPorEstado = $todosBens->countBy('estado');

        $data = [
            'bensAgrupados' => $bensAgrupados,
            'totalBens' => $todosBens->count(),
            'contagemPorEstado' => $contagemPorEstado,
            'dataGeracao' => now()->format('d/m/Y H:i:s'),
        ];

        $pdf = Pdf::loadView('relatorios.bens_geral', $data);

        return $pdf->stream('inventario_geral_de_bens.pdf');
    }

    public function gerarRelatorioResponsavel(User $user)
    {
        Gate::authorize("viewAny", User::class);

        $bensDoResponsavel = Bem::where('responsavel_id', $user->id)
            ->orderBy('estado')
            ->orderBy('patrimonio')
            ->get();

        $bensAgrupados = $bensDoResponsavel->groupBy('estado');
        $contagemPorEstado = $bensDoResponsavel->countBy('estado');

        $data = [
            'responsavel' => $user,
            'bensAgrupados' => $bensAgrupados,
            'totalBensDoResponsavel' => $bensDoResponsavel->count(),
            'contagemPorEstado' => $contagemPorEstado,
            'dataGeracao' => now()->format('d/m/Y H:i:s'),
        ];

        $pdf = Pdf::loadView('relatorios.bens_por_responsavel', $data);

        $fileName = 'inventario-responsavel-' . Str::slug($user->name) . '.pdf';
        return $pdf->stream($fileName);
    }

    public function gerarRelatorioFichaDoBem(Bem $bem)
    {
        $bem->load(
            'user',
            'historicos.registrador',
            'historicos.responsavelAnterior',
            'historicos.responsavelAtual',
        );

        $data = [
            'bem' => $bem,
            'dataGeracao' => now()->format('d/m/Y H:i:s'),
        ];

        $pdf = Pdf::loadView('relatorios.ficha_bem', $data);

        $fileName = 'ficha-bem-' . $bem->patrimonio . '.pdf';
        return $pdf->stream($fileName);
    }
}
