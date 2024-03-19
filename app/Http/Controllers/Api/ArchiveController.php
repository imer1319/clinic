<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archive;
use App\Models\User;
use App\Models\Consultation;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    public function index(Consultation $consultation)
    {
        return $consultation->archives()->latest()->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'patient_id' => 'required|numeric|exists:App\Models\User,id',
            'consultation_id' => 'required|numeric|exists:App\Models\Consultation,id',
        ]);

        $archive = (new Archive)->fill($request->all());

        $archive->image = $request->file('image')->store('public/images');

        $archive->save();

        return $archive;
    }

    public function destroy(Archive $archive)
    {
        $url = str_replace('storage', 'public', $archive->image);
        Storage::delete($url);

        return $archive->delete();
    }
}
