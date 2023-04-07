<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['surnames', 'ci', 'specialty_id', 'celular', 'nacimiento', 'gender', 'address'];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function diaries()
    {
        return $this->hasMany(Diary::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }
}
