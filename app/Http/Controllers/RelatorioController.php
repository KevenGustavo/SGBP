<?php

namespace App\Http\Controllers;

use App\Models\Bem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function gerarRelatorioBens()
    {
        $bens = Bem::with('user')->orderBy('created_at','desc')->get();
        $dataParaView = [
            'bens' => $bens,
            'dataGeracao'=>now()->format('d/m/Y H:i:s'),
        ];

        $pdf = Pdf::loadView('relatorios.relatorio_teste', $dataParaView);

        // Para fazer o download do PDF
        // return $pdf->download('relatorio_bens.pdf');

        return $pdf->stream('relatorio_bens.pdf');
    }
}
