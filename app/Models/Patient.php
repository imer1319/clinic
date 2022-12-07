<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['name','surnames','ci','phone','address'];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
