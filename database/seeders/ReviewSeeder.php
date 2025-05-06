<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::create([
            'mentoring_session_id' => 1,
            'mahasiswa_id' => 3,
            'rating' => 5,
            'comment' => 'Mentornya sangat membantu dan komunikatif!'
        ]);
    }
}
