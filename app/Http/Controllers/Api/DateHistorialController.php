<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DateHistorial;
use App\Http\Requests\DateHistorial\StoreRequest;

class DateHistorialController extends Controller
{
    public function index(User $patient)
    {
        return $patient->dateHistorial;
    }

    public function update(StoreRequest $request, DateHistorial $dateHistorial)
    {
        return $dateHistorial->update($request->validated());
    }
}
