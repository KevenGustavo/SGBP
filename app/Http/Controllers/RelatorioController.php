<?php

namespace App\Http\Controllers;

use App\Models\Bem;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function gerarRelatorioBens()
    {
        Gate::authorize("viewAny", User::class);

        $bens = Bem::with('user')->orderBy('created_at','desc')->get();
        $dataParaView = [
            'bens' => $bens,
            'dataGeracao'=>now()->format('d/m/Y H:i:s'),
        ];

        $pdf = Pdf::loadView('relatorios.relatorio_teste', $dataParaView);

        return $pdf->stream('relatorio_bens.pdf');
    }

    public function gerarRelatorioResponsavel(User $user){
        Gate::authorize("viewAny", User::class);

        $bens = $user->bem;
        $dataParaView = [
            'bens' => $bens,
            'dataGeracao'=>now()->format('d/m/Y H:i:s'),
        ];
        $pdf = Pdf::loadView('relatorios.relatorio_teste', $dataParaView);

        return $pdf->stream('relatorio_bens.pdf');

    }
}
