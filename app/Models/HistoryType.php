<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryType extends Model
{
    protected $fillable = ['title'];
    use HasFactory;

    public function historyQuestions()
    {
        return $this->hasMany(HistoryQuestion::class);
    }
}
