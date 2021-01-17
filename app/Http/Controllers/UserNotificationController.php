<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function notifications()
    {
        return view('profile.notifications');
    }

    public function index()
    {
        return Auth::user()->unreadNotifications;
    }

    public function destroy(User $user, $notificationId)
    {
        Auth::user()->notifications()->findOrFail($notificationId)->markAsRead();
    }
}
