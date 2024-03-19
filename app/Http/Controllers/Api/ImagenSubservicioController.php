<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImagenSubservicio;

class ImagenSubservicioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'consultation_subservice_id' => 'required|numeric|exists:App\Models\ConsultaSubservicio,id',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imagen = (new ImagenSubservicio)->fill($request->all());
        $imagen->imagen = $request->file('imagen')->store('public/images');
        $imagen->save();
        return $imagen;
    }
}
