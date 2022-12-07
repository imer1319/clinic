<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['name','surnames','ci'];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
