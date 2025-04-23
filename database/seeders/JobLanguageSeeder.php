<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Language;
use Illuminate\Database\Seeder;

class JobLanguageSeeder extends Seeder
{
    public function run()
    {
        $jobs = Job::all();


        $languages = Language::all();

        foreach ($jobs as $job) {
            $job->languages()->attach($languages->random(2)->pluck('id')->toArray());
        }
    }
}

