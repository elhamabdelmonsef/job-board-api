<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Location;
use Illuminate\Database\Seeder;

class JobLocationSeeder extends Seeder
{
    public function run()
    {
        $jobs = Job::all();
        $locations = Location::all();

        foreach ($jobs as $job) {
            $job->locations()->attach($locations->random(1)->pluck('id')->toArray());
        }
    }
}
