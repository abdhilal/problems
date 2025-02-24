<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProblemController extends Controller
{

// عرض تفاصيل مشكلة معينة
public function show( $id)
{
    $problem=Problem::find($id);
    return view('problems.show', compact('problem'));
}
     // عرض قائمة المشاكل
     public function index()
     {
         // استرجاع جميع المشاكل مع حالة "مفتوحة" وترتيبها من الأحدث إلى الأقدم
         $problems = Problem::latest()->get();

         // إرسال البيانات إلى الواجهة
         return view('problems.index', compact('problems'));
     }
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        return view('problems.create');
    }



 // حفظ المشكلة في قاعدة البيانات
 public function store(Request $request)
 {
     // التحقق من صحة البيانات
     $request->validate([
         'title'       => 'required|string|max:255',
         'description' => 'required|string',
         'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif',
         'priority'    => 'required|in:normal,urgent,emergency',
         'location'    => 'required|string',
     ]
    );

     // رفع الصورة إذا تم إرسالها
     $imagePath = null;
     if ($request->hasFile('image')) {
         $imagePath = $request->file('image')->store('problems', 'public');
     }

     // إنشاء المشكلة
     Problem::create([
         'user_id'     => Auth::id(), // المستخدم الحالي
         'title'       => $request->title,
         'description' => $request->description,
         'image'       => $imagePath,
         'priority'    => $request->priority,
         'location'    => $request->location,
         'status'      => 'open', // الحالة تبدأ كـ "مفتوحة"
     ]);

     return redirect()->route('my.problems')->with('success', 'تم إنشاء المشكلة بنجاح!');
 }
    /**
     * Display the specified resource.
     */



     public function myproblems(){

        $problems = Problem::where('user_id', Auth::id())->latest()->get();

        // إرسال البيانات إلى الواجهة
        return view('dashboard.my-problems', compact('problems'));
     }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Problem $problem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Problem $problem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Problem $problem)
    {
        //
    }
}
