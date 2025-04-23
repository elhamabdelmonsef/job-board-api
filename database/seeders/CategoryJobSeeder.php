<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryJobSeeder extends Seeder
{
    public function run()
    {
        $jobs = Job::all();
        $categories = Category::all();

        foreach ($jobs as $job) {
            $job->categories()->attach($categories->random(2)->pluck('id')->toArray());
        }
    }
}
