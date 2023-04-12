<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfile\UpdateRequest;

class UsersProfileController extends Controller
{
    public function update(UpdateRequest $request, User $user)
    {
        if ($request->hasFile('image')) {
            $user->profile->image = $request->file('image')->store('public/images');
        }
        $user->profile()->update([
            'surnames' => $request->surnames,
            'ci' => $request->ci,
            'nacimiento' => $request->nacimiento,
            'address' => $request->address,
            'celular' => $request->celular,
            'gender' => $request->gender,
            'specialty_id' => $request->specialty_id,
            'image' => $user->profile->image 
        ]);
        return redirect()->route('admin.users.edit', $user)->withFlash('Se han actualizado los datos');
    }
}
