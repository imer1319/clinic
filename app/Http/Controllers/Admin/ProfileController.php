<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(UpdateRequest $request, User $user)
    {
        $user->profile()->update([
            'surnames' => $request->surnames,
            'ci' => $request->ci,
            'nacimiento' => $request->nacimiento,
            'celular' => $request->celular,
            'address' => $request->address,
            'specialty_id' => $request->specialty_id,
            'gender' => $request->gender,
        ]);
        return redirect()->route('admin.doctors.index')->with('flash', 'Doctor actualizado corretamente');
    }
}
