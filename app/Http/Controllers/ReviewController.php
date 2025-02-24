<?php

namespace App\Http\Controllers;

use App\Models\Artisan;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
   // عرض نموذج إضافة تقييم
   public function create(Artisan $artisan)
   {
       return view('reviews.create', compact('artisan'));
   }

   // حفظ التقييم في قاعدة البيانات
   public function store(Request $request, Artisan $artisan)
   {
       // التحقق من صحة البيانات
       $request->validate([
           'rating' => 'required|integer|between:1,5',
           'comment' => 'nullable|string',
       ]);

       // حفظ التقييم في قاعدة البيانات
       $review = new Review();
       $review->user_id = Auth::id(); // المستخدم الحالي
       $review->artisan_id = $artisan->id;
       $review->rating = $request->rating;
       $review->comment = $request->comment;
       $review->save();

       return redirect()->route('artisans.show', $artisan)->with('success', 'تم إضافة التقييم بنجاح!');
   }
}
