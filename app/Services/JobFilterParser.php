<?php

namespace App\Services;

class JobFilterParser
{
    public static function parse(string $rawFilter): array
    {


        $filters = [];


        if (preg_match('/job_type=([a-zA-Z\-]+)/', $rawFilter, $matches)) {
            $filters['job_type'] = $matches[1];
        }

        if (preg_match('/languages HAS_ANY \(([^)]+)\)/', $rawFilter, $matches)) {
            $filters['languages'] = explode(',', str_replace(' ', '', $matches[1]));
        }

        // Locations IS_ANY
        if (preg_match('/locations IS_ANY \(([^)]+)\)/', $rawFilter, $matches)) {
            $filters['locations'] = explode(',', str_replace(' ', '', $matches[1]));
        }

        // attribute:years_experience >= X
        if (preg_match('/attribute:years_experience>=(\d+)/', $rawFilter, $matches)) {
            $filters['attributes']['years_experience']['min'] = (int)$matches[1];
        }

        return $filters;
    }
}

