<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Membuat akun admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'), // ganti dengan password yang aman
            'role' => 'admin',
        ]);

        // Membuat akun pelatih
        User::create([
            'name' => 'Pelatih User',
            'email' => 'pelatih@gmail.com',
            'password' => Hash::make('password123'), // ganti dengan password yang aman
            'role' => 'pelatih',
        ]);

        // Membuat akun karyawan
        User::create([
            'name' => 'Karyawan User',
            'email' => 'karyawan@gmail.com',
            'password' => Hash::make('password123'), // ganti dengan password yang aman
            'role' => 'karyawan',
        ]);
    }
}
