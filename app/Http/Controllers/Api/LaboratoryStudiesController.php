<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laboratory;
use Illuminate\Http\Request;

class LaboratoryStudiesController extends Controller
{
    public function index()
    {
        return Laboratory::where('status', 'ACTIVO')->get();
    }
}
