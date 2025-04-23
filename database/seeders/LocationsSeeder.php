<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    public function run()
    {
        Location::create(['city' => 'New York', 'state' => 'New York', 'country' => 'USA']);
        Location::create(['city' => 'Berlin', 'state' => null, 'country' => 'Germany']);
        Location::create(['city' => 'London', 'state' => null, 'country' => 'UK']);
        Location::create(['city' => 'Cairo', 'state' => 'Cairo', 'country' => 'Egypt']);
        Location::create(['city' => 'Paris', 'state' => null, 'country' => 'France']);
        Location::create(['city' => 'Tokyo', 'state' => null, 'country' => 'Japan']);
        Location::create(['city' => 'Dubai', 'state' => null, 'country' => 'UAE']);
        Location::create(['city' => 'Sydney', 'state' => 'New South Wales', 'country' => 'Australia']);
    }
}

