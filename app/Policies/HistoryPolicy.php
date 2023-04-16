<?php

namespace App\Policies;

use App\Models\User;
use App\Models\HistoryPatient;
use Illuminate\Auth\Access\HandlesAuthorization;

class HistoryPolicy
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

    public function view(User $user, HistoryPatient $history)
    {
        if ( $user->hasRole('Administrador') || $user->hasRole('Paciente') && $user->id === $history->patient_id) {
            return true;
        }
        return false;
    }
}
