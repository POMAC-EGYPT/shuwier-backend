<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\FreelancerProfile;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // for ($i = 1; $i <= 30; $i++) {
        //     $user = User::create([
        //         'name' => 'Freelancer' . $i,
        //         'email' => 'freelancer' . $i . '@example.com',
        //         'phone' => '123456789' . $i,
        //         'password' => bcrypt('password'),
        //         'type' => 'freelancer',
        //         'is_active' => 1,
        //         'about_me' => 'Experienced freelancer with skills in various domains.',
        //         'approval_status' => 'requested'
        //     ]);

        //     FreelancerProfile::create([
        //         'user_id' => $user->id,
        //         'headline' => 'Professional Freelancer',
        //         'portfolio_link' => 'https://portfolio.freelancer' . $i . '.com'
        //     ]);
        // }

        User::all()->each(function ($user) {
            if ($user->username === null) {
                $user->username = $user->name . $user->id;
                $user->save();
            }
        });
    }
}
