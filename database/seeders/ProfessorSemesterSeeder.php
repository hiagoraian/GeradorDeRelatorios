<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessorSemesterSeeder extends Seeder
{
    public function run(): void
    {
        $professor = DB::table('users')->where('email', 'professor@unimontes.com')->first();

        if ($professor) {
            DB::table('professor_semesters')->insert([
                'user_id' => $professor->id,
                'semester' => '2025.2',
                'employment_type' => 'Efetivo',
                'is_active' => true,
                'report_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
