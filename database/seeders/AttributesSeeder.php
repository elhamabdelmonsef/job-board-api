<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributesSeeder extends Seeder
{
    public function run(): void
    {
        $attributes = [
            ['name' => 'years_experience', 'type' => 'number', 'options' => null],
            ['name' => 'education_level', 'type' => 'select', 'options' => json_encode(['High School', 'Bachelor', 'Master'])],
            ['name' => 'remote_friendly', 'type' => 'boolean', 'options' => null],
        ];

        foreach ($attributes as $attr) {
            Attribute::create($attr);
        }
    }
}
