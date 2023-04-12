<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'surnames',
        'ci',
        'nacimiento',
        'celular',
        'address',
        'gender',
        'image',
        'specialty_id',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialty()
    {
        return $this->hasOne(Specialty::class);
    }
}
