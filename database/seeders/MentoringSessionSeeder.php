<?php

namespace Database\Seeders;

use App\Models\MentoringSession;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MentoringSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mentor = User::where('role', 'mentor')->first();

        MentoringSession::create([
            'mentor_id' => $mentor->id,
            'title' => 'Dasar Jaringan Komputer',
            'description' => 'Sesi belajar untuk memahami konsep dasar jaringan.',
            'scheduled_at' => now()->addDays(3),
            'status' => 'upcoming',
            'group_link' => 'https://t.me/group_jaringan',
        ]);

        MentoringSession::create([
            'mentor_id' => $mentor->id,
            'title' => 'Belajar Linux untuk Pemula',
            'description' => 'Menggunakan CLI, package manager, dan permission dasar.',
            'scheduled_at' => now()->addDays(5),
            'status' => 'upcoming',
            'group_link' => 'https://wa.me/linux_mentoring',
        ]);
    }
}
