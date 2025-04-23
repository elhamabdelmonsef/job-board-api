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
        $this->call([
            JobsSeeder::class,
            LanguagesSeeder::class,
            JobLanguageSeeder::class,
            LocationsSeeder::class,
            JobLocationSeeder::class,
            CategoriesSeeder::class,
            CategoryJobSeeder::class,
            AttributesSeeder::class,
            JobAttributeValuesSeeder::class,
        ]);
    }
}
