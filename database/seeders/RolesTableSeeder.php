<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Verificar si la tabla está vacía antes de insertar
        if (DB::table('roles')->count() == 0) {
            DB::table('roles')->insert([
                ['nombre' => 'admin', 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'usuario', 'created_at' => now(), 'updated_at' => now()]
            ]);
        }
    }
}