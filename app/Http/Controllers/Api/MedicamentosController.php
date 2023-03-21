<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicamentosController extends Controller
{
    public function index()
    {
        return Medicine::where('status','ACTIVO')->get();
    }
}
