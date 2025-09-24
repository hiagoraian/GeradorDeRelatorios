<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa a tabela antes de inserir para evitar duplicatas
        DB::table('users')->truncate();

        DB::table('users')->insert([
            // Usuário Administrador
            [
                'name' => 'Admin Principal',
                'masp' => '123456-7',
                'email' => 'admin@unimontes.com',
                'password' => Hash::make('admin123'), // Senha: admin123
                'is_adm' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Usuário Professor
            [
                'name' => 'Carlos Professor',
                'masp' => '987654-3',
                'email' => 'professor@unimontes.com',
                'password' => Hash::make('prof123'), // Senha: prof123
                'is_adm' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}