<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;

    protected $fillable = ['amount','appointment_id'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function getCreatedAt()
    {
        return $this->created_at->format('Y-m-d');
    }
}
