<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    public function run()
    {
        Language::create(['name' => 'English']);
        Language::create(['name' => 'Arabic']);
        Language::create(['name' => 'German']);
        Language::create(['name' => 'French']);
        Language::create(['name' => 'Spanish']);
    }
}
