<?php

namespace App\Observers;

use App\Models\Bem;
use App\Models\Historico;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $actingUser = Auth::user();
        $historicoAnterior = $bem->ultimoHistorico;

        if (!$actingUser){
            $fallbackUser = User::where('isAdmin', '==', true)->orderBy('created_at', 'asc')->first();

            if (!$fallbackUser) {
                $errorMessage = "Não foi possivel achar um usuário para fazer o fallback";
                Log::error($errorMessage);
                throw new Exception($errorMessage);
            }

            $actingUser = $fallbackUser;
            Log::info("Usuário de fallback '{$fallbackUser->name}' (ID: {$fallbackUser->id}) assumirá o registro.");
        }

        if ($bem->wasChanged("localizacao")) {

            Historico::create([
                "bem_id" => $bem->id,
                "tipo" => "Transferência de Localização",
                "localizacao_atual" => $bem->localizacao,
                "localizacao_anterior" => $historicoAnterior->localizacao_atual,
                "responsavel_atual_id" => $bem->responsavel_id,
                "registrador_id" => $actingUser->id,
            ]);
        } elseif ($bem->wasChanged("responsavel_id")) {

            Historico::create([
                "bem_id" => $bem->id,
                "tipo" => "Transferência de Responsável",
                "localizacao_atual" => $bem->localizacao,
                "responsavel_atual_id" => $bem->responsavel_id,
                "responsavel_anterior_id" => $historicoAnterior->responsavel_atual_id,
                "registrador_id" => $actingUser->id,
            ]);
        }
    }

}
