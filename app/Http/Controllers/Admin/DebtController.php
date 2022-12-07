<?php

namespace App\Http\Controllers\Admin;

use App\Models\Debt;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Requests\Debt\StoreRequest;
use App\Http\Controllers\Controller;

class DebtController extends Controller
{
    public function store(StoreRequest $request, Appointment $appointment)
    {
        $appointment->debts()->create($request->validated());
        
        if($request->input('total_debts') + $request->input('amount') == $request->input('total'))
        {
            $appointment->status = 'PAGADO';
            $appointment->save();
        }

        return redirect()->route('admin.appointments.show', $appointment)->with('flash', 'Deuda creado corretamente');
    }

    public function destroy(Debt $debt)
    {
        $debt->delete();

        $debt->appointment()->update(['status' => 'DEUDA']);

        return redirect()->back()->with('flash', 'Eliminado corretamente');
    }
}
