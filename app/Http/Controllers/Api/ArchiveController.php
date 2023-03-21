<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archive;
use App\Models\Patient;

class ArchiveController extends Controller
{
    public function index(Patient $patient)
    {
        return $patient->archives;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'patient_id' => 'required|numeric|exists:App\Models\Patient,id',
        ]);

        $archive = (new Archive)->fill($request->all());

        $archive->image = $request->file('image')->store('public/images');

        $archive->save();
        return $archive;
    }

    public function destroy(Archive $archive)
    {
      unlink(storage_path('app/'.$archive->image));

      return $archive->delete();
  }
}
