<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('professor_semesters')->truncate();
        DB::table('reports')->truncate();
        DB::table('users')->truncate();

        Schema::enableForeignKeyConstraints();

        $this->call([
            UserSeeder::class,
            ProfessorSemesterSeeder::class,
        ]);
    }
}
