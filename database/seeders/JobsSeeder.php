<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobsSeeder extends Seeder
{
    public function run()
    {
        Job::create([
            'title' => 'Senior PHP Developer',
            'description' => 'We are looking for a senior PHP developer with strong experience in Laravel.',
            'company_name' => 'Tech Solutions Inc.',
            'salary_min' => 5000.00,
            'salary_max' => 8000.00,
            'is_remote' => true,
            'job_type' => 'full-time',
            'status' => 'published',
            'published_at' => now(),
        ]);

        Job::create([
            'title' => 'Frontend Developer',
            'description' => 'Join our team as a frontend developer with expertise in React and JavaScript.',
            'company_name' => 'Creative Labs',
            'salary_min' => 3500.00,
            'salary_max' => 5500.00,
            'is_remote' => false,
            'job_type' => 'part-time',
            'status' => 'draft',
            'published_at' => null,
        ]);

        Job::create([
            'title' => 'Freelance Mobile Developer',
            'description' => 'We are looking for a freelance mobile developer with experience in Flutter and React Native.',
            'company_name' => 'Freelance Hub',
            'salary_min' => 2000.00,
            'salary_max' => 4000.00,
            'is_remote' => true,
            'job_type' => 'freelance',
            'status' => 'published',
            'published_at' => now(),
        ]);
    }
}

