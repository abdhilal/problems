<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function index()
    {

        $notifications = Notification::where('user_id', Auth::user()->id)->latest()->get();
        return view('notifications.index', compact('notifications'));
    }


    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        $notification->update([

            'read_at' => Carbon::now()
        ]);
    }


}
