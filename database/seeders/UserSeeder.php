<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin NF',
            'email' => 'admin@belajarbareng.nf',
            'password' => Hash::make('123'),
            'role' => 'admin',
        ]);

        // Mentor
        User::create([
            'name' => 'Mentor Andi',
            'email' => 'andi@mentor.com',
            'password' => Hash::make('123'),
            'role' => 'mentor',
        ]);

        // mahasiswa
        User::create([
            'name' => 'Mentee Budi',
            'email' => 'budi@mentee.com',
            'password' => Hash::make('123'),
            'role' => 'mahasiswa',
        ]);
    }
}
