<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = ['title','patient_id','image'];

    protected $casts = [
        'created_at' => 'datetime:d M Y H:i A',
    ];
    
    public function getImageAttribute($image)
    {
        return asset(\Storage::url($image));
    }

}
