<?php

namespace App\Observers;

use App\Models\Bem;
use App\Models\Historico;
use Illuminate\Support\Facades\Auth;

class BemObserver
{
    /**
     * Handle the Bem "created" event.
     */
    public function created(Bem $bem): void
    {
        Historico::create([
            "bem_id" => $bem->id,
            "tipo" => "Criação do Bem",
            "localizacao_atual" => $bem->localizacao,
            "responsavel_atual_id" => $bem->responsavel_id,
            "registrador_id" => Auth::id(),
        ]);
    }

    /**
     * Handle the Bem "updated" event.
     */
    public function updated(Bem $bem): void
    {
        $historicoAnterior = $bem->ultimoHistorico;

        if ($bem->wasChanged("localizacao")) {

            Historico::create([
                "bem_id" => $bem->id,
                "tipo" => "Transferência de Localização",
                "localizacao_atual" => $bem->localizacao,
                "localizacao_anterior" => $historicoAnterior->localizacao_atual,
                "responsavel_atual_id" => $bem->responsavel_id,
                "registrador_id" => Auth::id(),
            ]);

        }elseif ($bem->wasChanged("responsavel_id")) {

            Historico::create([
                "bem_id" => $bem->id,
                "tipo"=>"Transferência de Responsável",
                "localizacao_atual" => $bem->localizacao,
                "responsavel_atual_id" => $bem->responsavel_id,
                "responsavel_anterior_id" => $historicoAnterior->responsavel_atual_id,
                "registrador_id" => Auth::id(),
            ]);
        }
    }

    /**
     * Handle the Bem "deleted" event.
     */
    public function deleted(Bem $bem): void
    {
        //
    }
}
