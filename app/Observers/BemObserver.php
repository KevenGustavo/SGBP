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
            "bem_id"=>$bem->id,
            "localizacao_atual"=>$bem->id,
            "responsavel_atual_id"=>$bem->responsavel_id,
            "registrador_id"=>Auth::id(),
        ]);
    }

    /**
     * Handle the Bem "updated" event.
     */
    public function updated(Bem $bem): void
    {
        //
    }

    /**
     * Handle the Bem "deleted" event.
     */
    public function deleted(Bem $bem): void
    {
        //
    }

}
