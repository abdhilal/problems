<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class ArtisanNotificationController extends Controller
{

    public function index()
    {
        
        return view('notifications.artisans.index');
    }

    // تحديد الإشعار كمقروء
    public function markAsRead($notificationid)
    {
        $notification = DatabaseNotification::findOrFail($notificationid);
        // التحقق من أن الإشعار يخص المستخدم الحالي
        if ($notification->notifiable_id === Auth::user()->artisan->id) {
            $notification->markAsRead(); // تحديد الإشعار كمقروء
            return redirect($notification->data['url']); // توجيه المستخدم إلى صفحة المشكلة
        }

        return redirect()->back()->with('error', 'غير مصرح لك بهذا الإجراء.');
    }

    }
