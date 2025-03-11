<?php

namespace App\Http\Controllers;

use App\Events\BroadCast;
use App\Models\Artisan;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\Problem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    // تقديم عرض جديد
    public function store(Request $request, $problem)
    {
        // التحقق من أن المستخدم حرفي
        if (auth::user()->role !== 'artisan') {
            abort(403, 'غير مصرح لك بتقديم عروض');
        }

        // التحقق من صحة البيانات
        $request->validate([
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);


        // حفظ العرض في قاعدة البيانات
        $offer = new Offer();
        $offer->artisan_id = Auth::user()->artisan->id; // الحرفي الحالي
        $offer->problem_id = $problem;
        $offer->price = $request->price;
        $offer->description = $request->description;
        $offer->status = 'pending'; // حالة العرض
        $offer->save();

        $problem = $offer->problem;

        $message = "تم استلام عرض جديد لمشكلتك : {$problem->title}";

        Notification::create([
            'problem_id'=>$problem->id,
            'user_id' => $problem->user_id,
            'message' => $message,
        ]);

        event(new BroadCast($problem->user_id, $message));




        return redirect()->route('problems.show', $problem)->with('success', 'تم تقديم العرض بنجاح!');
    }

    // قبول عرض معين
    public function accept(Problem $problem, Offer $offer)
    {
        // التحقق من أن المستخدم هو صاحب المشكلة
        if (Auth::user()->id !== $problem->user_id) {
            abort(403, 'غير مصرح لك بقبول هذا العرض');
        }

        // تحديث حالة العرض
        $offer->status = 'accepted';
        $offer->save();

        // تحديث حالة المشكلة
        $problem->status = 'resolved';
        $problem->save();

        // إرسال إشعار للحرفي
        $message = "تم قبول عرضك للمشكلة : {$offer->problem->title}";

        $user_id=Artisan::find($offer->artisan->id);
        Notification::create([
            'problem_id'=>$problem->id,
            'user_id' => $user_id->user->id,
            'message' => $message,
        ]);

        event(new BroadCast($user_id->user->id, $message));

        return redirect()->route('problems.show', $problem)->with('success', 'تم قبول العرض بنجاح!');
    }


    //رفض عرض
    public function reject(Problem $problem, Offer $offer)
    {
        // التحقق من أن المستخدم هو صاحب المشكلة
        if (Auth::user()->id !== $problem->user_id) {
            abort(403, 'غير مصرح لك بقبول هذا العرض');
        }

        // تحديث حالة العرض
        $offer->status = 'rejected';
        $offer->save();

        // إرسال إشعار للحرفي
        $message = "تم رفض عرضك لمشكلة : {$offer->problem->title}";
        $user_id=Artisan::find($offer->artisan->id);
        Notification::create([
            'problem_id'=>$problem->id,
            'user_id' => $user_id->user->id,
            'message' => $message,
        ]);

        event(new BroadCast($user_id->user->id, $message));

        return redirect()->route('problems.show', $problem)->with('success', 'تم رفض العرض بنجاح!');
    }



    public function sendNotification()
    {
        // event(new BroadCast(['message' => 'تم تحديث الإشعارات']));

        return response()->json([
            'status' => 'success',
            'message' => 'تم إرسال الإشعار بنجاح'
        ]);
    }
}
