<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Http\Request;
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
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ];
    // loading the last 5 years
        for ($i = 4; $i > -1; $i--) 
        {
            $year[] = $date->year - $i;
        }
    // user created for month
        for ($i = 1 ; $i<= 12; $i++){
            $patientMonth[] = Patient::whereYear('created_at',$date->year)->whereMonth('created_at', '=', $i)->count();
        }
    // user created for year
        foreach ($year as $value) 
        {
            $patientYear[] = Patient::where(DB::raw("DATE_FORMAT(created_at, '%Y')"), $value)->count();
        }

        return view('home',[
            'users' => User::count(),
            'patients' => Patient::count(),
            'doctors' => Doctor::count(),
            'services' => Service::count(),
            'appointments' => Appointment::where('status', 'DEUDA')->get(),
            'year' => $year,
            'patientYear' => $patientYear,
            'patientMonth' => $patientMonth,
            'meses' => $meses
        ]);
    }
}
