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
            $table->foreignId('bem_id')->constrained()->onDelete('cascade');
            $table->string('tipo');
            $table->string('localizacao_atual');
            $table->string('localizacao_anterior')->nullable();
            $table->unsignedBigInteger('responsavel_atual_id')->nullable();
            $table->unsignedBigInteger('responsavel_anterior_id')->nullable();
            $table->unsignedBigInteger('registrador_id');
            $table->timestamps();

            $table->foreign('responsavel_atual_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('responsavel_anterior_id')->references('id')->on('users')->onDelete('set null');
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
