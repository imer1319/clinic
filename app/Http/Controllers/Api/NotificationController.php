<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(User $user)
    {
        return $user->notifications;
    }

    public function update(Request $request, Notification $notification)
    {
        $notification->update([
            'leida' => 'SI'
        ]);
        return ;
    }
}