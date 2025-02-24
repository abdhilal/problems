<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    // إرسال إشعار للمستخدم
    public static function sendNotification($userId, $message)
    {
        Notification::create([
            'user_id' => $userId,
            'message' => $message,
        ]);
    }
}
