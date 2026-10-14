<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

          DB::table('cases')->insert([
            [
                'id' => 1,
                'title' => 'El robo del Museo',
                'description' => "Durante la inauguración de una exposición desaparece\r\nun diamante valorado en millones de euros.\r\n\r\nEl museo fue cerrado inmediatamente y nadie puede\r\nabandonar el edificio hasta que se aclare lo ocurrido.\r\n\r\nEl responsable del robo sigue dentro.\r\n\r\nTendrás que investigar los diferentes lugares,\r\nencontrar pistas y descubrir quién es el responsable.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'title' => 'Asesinato en el Hotel',
                'description' => 'Un empresario aparece muerto en la habitación 203. Todos los huéspedes son sospechosos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'title' => 'El robo del banco',
                'description' => 'Alguien vació una caja fuerte sin romper ninguna cerradura.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'title' => 'El Misterio de la Mansión',
                'description' => 'El dueño de una antigua mansión desaparece durante una cena familiar.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('scenarios')->insert([
            [
                'id' => 41,
                'case_id' => 1,
                'name' => 'Museo',
                'description' => 'la casa del guardia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 42,
                'case_id' => 1,
                'name' => 'Habitación',
                'description' => 'El robo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 43,
                'case_id' => 1,
                'name' => 'Comisaria',
                'description' => 'Final',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
