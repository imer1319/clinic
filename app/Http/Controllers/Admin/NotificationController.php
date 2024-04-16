<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Diary;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', '=', Auth::id())->get();
        return view('admin.notifications.index', compact('notifications'));
    }

    public function store(Diary $diary)
    {
        Notification::create([
            'user_id' => $diary->doctor->id,
            'body' => "Tienes una cita el ". $diary->date_cita->format('d, M') ." a las ".$diary->hora_cita->format('H:i A') ." Hrs con el paciente ". $diary->patient->name.", por motivo de ". $diary->motivo ."."
        ]);
        return redirect()->route('home')->with('flash','Se ha notificado al doctor');
    }
}
