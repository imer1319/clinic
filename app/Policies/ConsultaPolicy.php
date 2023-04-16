<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Consultation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConsultaPolicy
{
    use HandlesAuthorization;


    public function view(User $user, Consultation $consulta)
    {
        if ( $user->hasRole('Administrador') || $user->hasRole('Paciente') && $user->id === $consulta->patient_id && $user->id === $consulta->patient->id) {
            return true;
        }
        return false;
    }

}
