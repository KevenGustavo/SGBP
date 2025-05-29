<?php

namespace Database\Factories;

use App\Models\Bem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bem>
 */
class BemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "patrimonio"=>fake()->randomNumber(8),
            "responsavel_id"=>User::all()->random()->id,
            "descricao"=>fake()->text(100),
            "localizacao"=>fake()->locale(),
            "marca"=>fake()->word(),
            "tipoUso"=>fake()->randomElement([Bem::TIPOS_USO]),
            "estado"=>fake()->randomElement([Bem::ESTADOS]),
        ];
    }
}
