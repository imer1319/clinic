<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryQuestion extends Model
{
    protected $fillable = ['history_question_id','question','status'];
    use HasFactory;
}
