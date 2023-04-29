<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Diary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:dashboard_show')->only(['index']);
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $date = Carbon::now();

        $year = [];
        $patientMonth = [];
        $userYear = [];

        $meses = [
            "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ];
        // loading the last 5 years
        for ($i = 4; $i > -1; $i--) {
            $year[] = $date->year - $i;
        }
        // user created for month
        for ($i = 1; $i <= 12; $i++) {
            $consultations = '';
            if (Auth::user()->hasRole('Doctor')) {
                $patientMonth[] = Consultation::whereYear('created_at', $date->year)->whereMonth('created_at', '=', $i)->where('doctor_id', Auth::id())->count();
            } else {
                $patientMonth[] = Consultation::whereYear('created_at', $date->year)->whereMonth('created_at', '=', $i)->count();
            }
        }
        // user created for year
        foreach ($year as $value) {
            $patientYear[] = User::patients()->where(DB::raw("DATE_FORMAT(created_at, '%Y')"), $value)->count();
        }
        $consultations = '';
        if (Auth::user()->hasRole('Doctor')) {
            $diaries =  Diary::where('doctor_id', Auth::id())->get();
            $consultations =  Consultation::where('doctor_id', Auth::id())->get();
        } else {
            $diaries =  Diary::all();
            $consultations =  Consultation::all();
        }
        return view('home', [
            'users' => User::count(),
            'patients' => User::patients()->count(),
            'doctors' => User::doctors()->count(),
            'services' => Service::count(),
            'diaries' => $diaries,
            'consultations' => $consultations,
            'year' => $year,
            'patientYear' => $patientYear,
            'patientMonth' => $patientMonth,
            'meses' => $meses
        ]);
    }
}
