<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // user with only required attributes
        \App\Models\User::factory()->create();

        \App\Models\User::factory()->create([
            'name' => 'Fully-Featured User',
            'email' => 'test@example.com',
            'role' => \App\Enums\UserRole::PROFESSIONAL,
            'bigint_without_cast' => 12,
            'names_of_siblings' => ['Techno', 'Saxon', 'Griffin', 'Damian', 'Kai'],
            'secret_question' => 'What is your favorite PHP framework?',
            'is_active' => true,
            'cohort_month' => \Carbon\Carbon::now(),
            'signup_fee' => '12.99',
            'rand_double' => rand()/(10^24*1.0),
            'secret_answer' => 'Laravel',
            'rand_float' => rand(0,10^3)/(10^3*1.0),
            'options' => [
                'dark_mode' => false,
                'notifications' => true,
                'require_2fa' => 'always',
            ],
            'login_count' => 3,
            'last_login_ts' => \Carbon\Carbon::now(),
        ]);
    }
}
