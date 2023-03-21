<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = ['title','patient_id','image'];

    public function getImageAttribute($image)
    {
        return asset(\Storage::url($image));
    }
}
