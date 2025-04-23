<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Software Engineering']);
        Category::create(['name' => 'Data Science']);
        Category::create(['name' => 'Marketing']);
        Category::create(['name' => 'Design']);
        Category::create(['name' => 'Sales']);
    }
}
