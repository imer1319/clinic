<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'status'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i A',
    ];
}
