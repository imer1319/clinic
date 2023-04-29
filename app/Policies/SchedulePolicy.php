<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Horario;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchedulePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Horario $schedule)
    {
        if ($user->hasRole('Administrador')) {
            return true;
        }

    // Si el usuario es un doctor y está intentando ver su propio horario, se le permite la visualización
        if ($user->hasRole('Doctor') && $user->id === $schedule->doctor_id) {
            return true;
        }

    // De lo contrario, no se le permite la visualización
        return false;
    }

}
