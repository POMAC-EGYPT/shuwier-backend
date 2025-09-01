<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            $user = \App\Models\User::create([
            'first_name' => 'Freelancer' . $i,
            'last_name' => 'User' . $i,
            'email' => 'freelancer' . $i . '@example.com',
            'phone' => '123456789' . $i,
            'password' => bcrypt('password'),
            'type' => 'freelancer',
            'is_active' => 1,
            'about_me' => 'Experienced freelancer with skills in various domains.',
            'approval_status' => 'requested'
            ]);

            \App\Models\FreelancerProfile::create([
            'user_id' => $user->id,
            'headline' => 'Professional Freelancer',
            'linkedin_link' => 'https://linkedin.com/in/freelancer' . $i,
            'portfolio_link' => 'https://portfolio.freelancer' . $i . '.com'
            ]);
        }
    }
}
