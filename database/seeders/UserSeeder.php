<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Siswa Satu',
            'email' => 'siswa@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);

        User::create([
            'name' => 'Ghefira',
            'email' => 'gep@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);
    }
}
