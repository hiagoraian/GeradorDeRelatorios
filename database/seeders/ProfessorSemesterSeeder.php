<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessorSemesterSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Encontrar o ID do usuário "Carlos Professor" que foi criado no UserSeeder
        $professor = DB::table('users')->where('email', 'professor@unimontes.com')->first();

        // 2. Se o professor foi encontrado, criar um registro para ele
        if ($professor) {
            DB::table('professor_semesters')->insert([
                'user_id' => $professor->id,
                'semester' => '2025.2', // Um semestre de exemplo
                'employment_type' => 'Efetivo',
                'is_active' => true,
                'report_id' => null, // O relatório ainda não foi enviado
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}