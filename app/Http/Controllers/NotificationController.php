<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // Bildirişləri tarixə görə sıralayırıq
        $notifications = Notification::where('notifiable_id', Auth::id())
            ->orderBy('created_at', 'desc')  // created_at üzrə sıralama
            ->get();

        return view('notifications.index', compact('notifications'));
    }
}
