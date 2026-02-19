<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear 10 usuarios de tipo público con sus perfiles correspondientes
        \App\Models\Publico::factory(10)->create();

        // Crear un usuario de prueba específico si no existe
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'nombre' => 'Test User',
                'email' => 'test@example.com',
                'tipo_usuario' => 'admin'
            ]);
        }
    }
}
