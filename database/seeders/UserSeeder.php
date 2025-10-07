<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        DB::table('users')->insert([
            // Usuário Administrador
            [
                'name' => 'Admin Principal',
                'masp' => '123456-7',
                'email' => 'admin@unimontes.com',
                'password' => Hash::make('admin123'),
                'phone' => '(38) 99999-0001',
                'is_adm' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Usuário Professor
            [
                'name' => 'Carlos Professor',
                'masp' => '987654-3',
                'email' => 'professor@unimontes.com',
                'password' => Hash::make('prof123'),
                'phone' => '(38) 99999-0002',
                'is_adm' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
