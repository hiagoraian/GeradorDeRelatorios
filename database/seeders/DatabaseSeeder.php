<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Desativa a verificação de chaves estrangeiras para permitir o truncate
        Schema::disableForeignKeyConstraints();

        // 2. Limpa as tabelas na ordem correta (filhas antes das pais)
        DB::table('professor_semesters')->truncate();
        DB::table('reports')->truncate();
        DB::table('users')->truncate();
        
        // 3. Reativa a verificação de chaves estrangeiras
        Schema::enableForeignKeyConstraints();

        // 4. Chama os seeders individuais na ordem de dependência
        $this->call([
            UserSeeder::class,
            ProfessorSemesterSeeder::class,
            // Adicione futuros seeders aqui
        ]);
    }
}