<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MedicalSpecialty;

class MedicalSpecialtyController extends Controller
{
    /**
     * Display a listing of medical specialty.
     * 
     * Return all medical specialties.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $medicalSpecialty = MedicalSpecialty::all();

        return response()->json($medicalSpecialty);
    }
}
