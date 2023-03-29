<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(User $user)
    {
        return $user->notifications()->where('leido', false)->get();
    }

    public function update(Notification $notification)
    {
        $notification->update([
            'leido' => true,
            'fecha_leida' => Carbon::now()
        ]);
        return ;
    }
}