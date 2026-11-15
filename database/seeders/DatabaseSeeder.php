<?php

namespace Database\Seeders;

use App\Models\Aula;
use App\Models\Departamento;
use App\Models\Estudiante;
use App\Models\EstudianteMateria;
use App\Models\Materia;
use App\Models\Profesor;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gesacad.com',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Profesor Demo',
            'email' => 'profesor@gesacad.com',
            'role' => 'profesor',
        ]);

        User::factory()->create([
            'name' => 'Estudiante Demo',
            'email' => 'estudiante@gesacad.com',
            'role' => 'estudiante',
        ]);

        Departamento::factory(10)->create();

        Profesor::factory(20)->create();

        Estudiante::factory(23)->create();

        Aula::factory(15)->create();

        Materia::factory(30)->create();

        $estudiantes = Estudiante::pluck('id');
        $materias = Materia::pluck('id');
        $periodos = ['2024-2025', '2025-2026', '2025-2026', '2025-2026', '2026-2027'];
        $pares = [];

        for ($i = 0; $i < 23; $i++) {
            $estudianteId = $estudiantes->random();
            $materiaId = $materias->random();
            $periodo = fake()->randomElement($periodos);

            $clave = "{$estudianteId}-{$materiaId}-{$periodo}";

            if (isset($pares[$clave])) {
                continue;
            }

            $pares[$clave] = true;

            EstudianteMateria::create([
                'estudiante_id' => $estudianteId,
                'materia_id' => $materiaId,
                'fecha_inscripcion' => fake()->date('Y-m-d', 'now'),
                'periodo' => $periodo,
                'estado' => fake()->randomElement(['Activo', 'Activo', 'Activo', 'Cancelado', 'Completado']),
            ]);
        }
    }
}
