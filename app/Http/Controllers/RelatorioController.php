<?php

namespace App\Http\Controllers;

use App\Models\Bem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function gerarRelatorioBens()
    {
        $bens = Bem::with('user')->get(); // Ou sua query específica
        $dataParaView = ['bens' => $bens];

        // Carrega a view e os dados, e então gera o PDF
        $pdf = Pdf::loadView('relatorios.relatorio_teste', $dataParaView);

        // Para fazer o download do PDF
        // return $pdf->download('relatorio_bens.pdf');

        // Para exibir o PDF no navegador
        return $pdf->stream('relatorio_bens.pdf');
    }
}
