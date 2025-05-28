<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    /** @use HasFactory<\Database\Factories\HistoricoFactory> */
    use HasFactory;

    protected $guarded = [];

    public function bem()
    {
        return $this->belongsTo(Bem::class);
    }

    public function registrador()
    {
        return $this->belongsTo(User::class, 'registrador_id');
    }

    public function responsavelAnterior()
    {
        return $this->belongsTo(User::class, 'responsavel_anterior_id');
    }

    public function responsavelAtual()
    {
        return $this->belongsTo(User::class, 'responsavel_atual_id');
    }
}
