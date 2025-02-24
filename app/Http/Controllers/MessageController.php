<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // عرض صفحة المحادثة
    public function index($receiverId)
    {
        $receiver = User::findOrFail($receiverId);
        $messages = Message::where(function ($query) use ($receiverId) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        return view('messages.index', compact('receiver', 'messages'));
    }

    // إرسال رسالة جديدة
    public function store(Request $request, $receiverId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $receiverId,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'تم إرسال الرسالة بنجاح!');
    }

    // تحديد الرسالة كمقروءة
    public function markAsRead($messageId)
    {
        $message = Message::findOrFail($messageId);
        if ($message->receiver_id == Auth::id()) {
            $message->update(['read' => true]);
        }

        return response()->json(['success' => true]);
    }


    public function conversations()
{
    $user = Auth::user();

    // المستخدمون الذين تبادلت معهم الرسائل
    $conversations = Message::where('sender_id', $user->id)
        ->orWhere('receiver_id', $user->id)
        ->with(['sender', 'receiver'])
        ->get()
        ->groupBy(function ($message) use ($user) {
            return $message->sender_id == $user->id ? $message->receiver_id : $message->sender_id;
        });

    return view('messages.conversations', compact('conversations'));
}
}
