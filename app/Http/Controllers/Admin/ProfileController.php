<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specialty;
use App\Http\Requests\Profile\UpdateRequest;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:profiles_edit')->only(['edit', 'update']);
    }

    public function show()
    {
        return view('admin.profiles.show');
    }

    public function edit()
    {
        $specialties = Specialty::all();
        return view('admin.profiles.edit', compact('specialties'));
    }

    public function update(UpdateRequest $request)
    {
        auth()->user()->update($request->validated());

        if ($request->hasFile('image')) {
            auth()->user()->profile->image = $request->file('image')->store('public/images');
        }
        auth()->user()->profile()->update([
            'surnames' => $request->surnames,
            'ci' => $request->ci,
            'nacimiento' => $request->nacimiento,
            'address' => $request->address,
            'celular' => $request->celular,
            'gender' => $request->gender,
            'specialty_id' => $request->specialty_id,
            'image' => auth()->user()->profile->image 
        ]);
        return redirect()->route('admin.profile.edit')->withFlash('Se han actualizado los datos');
    }
}
