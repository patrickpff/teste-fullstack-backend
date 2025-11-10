<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;

class RegionController extends Controller
{
    /**
     * Display a listing of regions.
     * 
     * Return all regions.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $regions = Region::all();

        return response()->json($regions);
    }
}
