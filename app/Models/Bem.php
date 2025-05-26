<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bem extends Model
{
    /** @use HasFactory<\Database\Factories\BemFactory> */
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,"responsavel_id");
    }
}
