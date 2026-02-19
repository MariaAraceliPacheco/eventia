<?php

namespace Database\Factories;

use App\Models\Publico;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publico>
 */
class PublicoFactory extends Factory
{
    protected $model = Publico::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_usuario' => User::factory(),
            'comunidad_autonoma' => fake()->state(),
            'localidad' => fake()->city(),
            'provincia' => fake()->state(), // Faking province with state for now
            'gustos_musicales' => fake()->randomElement(Publico::GUSTOS_MUSICALES),
            'tipo_eventos_favoritos' => fake()->randomElement(Publico::TIPO_EVENTOS_FAVORITOS),
            'notificaciones' => fake()->boolean(),
        ];
    }
}
