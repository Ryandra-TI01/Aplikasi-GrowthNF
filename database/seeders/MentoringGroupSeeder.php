<?php

namespace Database\Seeders;

use App\Models\MentoringGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MentoringGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MentoringGroup::create([
            'mentor_id' => 2, // Mentor Andi
            'name' => 'Belajar Laravel Bareng',
            'link' => 'https://chat.whatsapp.com/laravelgroup'
        ]);
    }
}
