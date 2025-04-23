<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Services\JobFilterParser;
use App\Services\JobFilterService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    protected $filterService;

    public function __construct(JobFilterService $filterService)
    {
        $this->filterService = $filterService;
    }

    public function index(Request $request)
    {
        $query = Job::query()->with(['languages', 'locations', 'categories', 'attributeValues.attribute']);
        $query->where('status', 'published');

        if ($request->has('filter')) {
            $rawFilter = $request->input('filter');
            $parsedFilter = JobFilterParser::parse($rawFilter);

            $filterService = new JobFilterService($parsedFilter);
            $query = $filterService->apply($query);
        }

        return $query->paginate($request->input('per_page', 15));
    }
}
