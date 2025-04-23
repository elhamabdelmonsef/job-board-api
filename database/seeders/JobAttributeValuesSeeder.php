<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Attribute;
use App\Models\JobAttributeValue;
use Illuminate\Database\Seeder;

class JobAttributeValuesSeeder extends Seeder
{
    public function run(): void
    {
        $attributes = Attribute::pluck('id', 'name');

        if ($attributes->isEmpty()) {
            $this->command->warn('No attributes found. Run AttributeSeeder first.');
            return;
        }

        $jobs = Job::all();

        if ($jobs->isEmpty()) {
            $this->command->warn('No jobs found in the database.');
            return;
        }

        foreach ($jobs as $job) {
            // Years of experience: 0 to 10
            JobAttributeValue::updateOrCreate([
                'job_id' => $job->id,
                'attribute_id' => $attributes['years_experience'],
            ], [
                'value' => rand(0, 10),
            ]);

            // Education level
            $educationLevels = ['High School', 'Bachelor', 'Master'];
            JobAttributeValue::updateOrCreate([
                'job_id' => $job->id,
                'attribute_id' => $attributes['education_level'],
            ], [
                'value' => $educationLevels[array_rand($educationLevels)],
            ]);

            // Remote friendly: 0 or 1
            JobAttributeValue::updateOrCreate([
                'job_id' => $job->id,
                'attribute_id' => $attributes['remote_friendly'],
            ], [
                'value' => rand(0, 1),
            ]);
        }

        $this->command->info('Job attribute values seeded for existing jobs.');
    }
}
