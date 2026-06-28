<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FilterGroupResource;
use App\Models\FilterGroup;

class FilterController extends Controller
{
    public function index()
    {
        $groups = FilterGroup::with('values')->orderBy('name')->get();

        return FilterGroupResource::collection($groups);
    }
}
