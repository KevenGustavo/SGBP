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
        Schema::create('historicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bem_id')->constrained();
            $table->timestamp('data_historico');
            $table->string('localizacao_atual');
            $table->string('localizacao_anterior');
            $table->unsignedBigInteger('responsavel_atual_id');
            $table->unsignedBigInteger('responsavel_anterior_id')->nullable();
            $table->unsignedBigInteger('registrador_id');

            $table->foreign('responsavel_atual_id')->references('id')->on('users');
            $table->foreign('responsavel_anterior_id')->references('id')->on('users');
            $table->foreign('registrador_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historicos');
    }
};
