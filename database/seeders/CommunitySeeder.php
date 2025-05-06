<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Community::create([
            'name' => 'NF Linux Club',
            'skill_id' => 2, // Linux
            'link' => 'https://t.me/nflinuxclub'
        ]);

        Community::create([
            'name' => 'NF Web Dev',
            'skill_id' => 3, // Web Dev
            'link' => 'https://chat.whatsapp.com/nfwebdev'
        ]);
    }
}
