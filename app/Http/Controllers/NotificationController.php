<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //جلب الاشعارات
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc') // ترتيب من الأقدم إلى الأحدث
        ->get();


        return view('notifications.index', compact('notifications'));
    }

        // تحديد الإشعار كمقروء
        public function markAsRead($id)
        {
            $notification = Notification::findOrFail($id);
            $notification->update(['read_at' => now()]);
            return redirect()->back()->with('success', 'تم تحديد الإشعار كمقروء.');
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
