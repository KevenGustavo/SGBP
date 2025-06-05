<?php

namespace App\Observers;

use App\Models\Bem;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }


    public function deleting(User $deletedUser): void
    {
        $actingUser = Auth::user();
        $newBemOwnerId = null;
        $newOwnerNameForLog = '';

        Log::info("Iniciando processo de exclusão para o usuário '{$deletedUser->name}' (ID: {$deletedUser->id}).");

        $bensSobResponsabilidade = Bem::where('responsavel_id', $deletedUser->id)->get();

        if ($bensSobResponsabilidade->isNotEmpty()) {

            if ($actingUser && $actingUser->id !== $deletedUser->id) {
                $newBemOwnerId = $actingUser->id;
                $newOwnerNameForLog = $actingUser->name;

            } else {
                $fallbackUser = User::where('id', '!=', $deletedUser->id)->orderBy('created_at', 'asc')->first();

                if (!$fallbackUser) {
                    $errorMessage = "Não é possível excluir o usuário '{$deletedUser->name}' pois ele é responsável por {$bensSobResponsabilidade->count()} bem(ns) e nenhum responsável substituto (usuário logado ou de fallback) foi encontrado. A exclusão foi cancelada.";
                    Log::error($errorMessage);
                    throw new Exception($errorMessage);
                }

                $newBemOwnerId = $fallbackUser->id;
                $newOwnerNameForLog = $fallbackUser->name;
                Log::info("Usuário de fallback '{$fallbackUser->name}' (ID: {$fallbackUser->id}) assumirá os bens.");
            }

            Log::info("Reatribuindo {$bensSobResponsabilidade->count()} bens de '{$deletedUser->name}' para '{$newOwnerNameForLog}' (ID: {$newBemOwnerId}).");

            Bem::where('responsavel_id', $deletedUser->id)->cursor()->each(function (Bem $bem) use ($newBemOwnerId) {
                $bem->responsavel_id = $newBemOwnerId;
                $bem->save();
            });

        } else {
            Log::info("Usuário '{$deletedUser->name}' não possui bens sob sua responsabilidade direta. Nenhuma reatribuição de bens necessária.");
        }
    }

}
