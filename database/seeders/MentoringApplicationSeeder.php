<?php

namespace Database\Seeders;

use App\Models\MentoringApplication;
use App\Models\MentoringSession;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MentoringApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswa = User::where('role', 'mahasiswa')->first();
        $sessions = MentoringSession::all();

        foreach ($sessions as $session) {
            MentoringApplication::create([
                'mentoring_session_id' => $session->id,
                'mahasiswa_id' => $mahasiswa->id,
                'status' => 'accepted',
                'note' => 'Saya sangat tertarik belajar topik ini!'
            ]);
        }
    }
}
