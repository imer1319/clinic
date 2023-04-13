<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use LaravelAndVueJS\Traits\LaravelPermissionToVueJS;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, LaravelPermissionToVueJS;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getRoleDisplayNames()
    {
        return $this->roles->pluck('name')->implode(', ');
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    
    public function consultations()
    {
        return $this->hasMany(Consultation::class,'doctor_id','patient_id');
    }

    public function vitalSigns()
    {
        return $this->hasMany(VitalSign::class);
    }

    public function archives()
    {
        return $this->hasMany(Archive::class);
    }

    public function dateHistorial()
    {
        return $this->hasOne(DateHistorial::class);
    }

    public function diaries()
    {
        return $this->hasMany(Diary::class,'doctor_id','patient_id');
    }

    public function scopeDoctors($query)
    {
        $query->whereHas('roles', function ($query) {
            return $query->where('name', '=', 'Doctor');
        });
    }

    public function scopePatients($query)
    {
        $query->whereHas('roles', function ($query) {
            return $query->where('name', '=', 'Paciente');
        });
    }
}
