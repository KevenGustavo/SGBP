<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('responsavel_id');
            $table->string('patrimonio');
            $table->text('descricao');
            $table->string('marca');
            $table->string('tipoUso');
            $table->string('localizacao');
            $table->timestamps();
            $table->foreign('responsavel_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bens');
    }
};
