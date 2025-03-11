<?php

namespace App\Http\Controllers;

use App\Events\BroadCast;
use App\Models\Artisan;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Problem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProblemController extends Controller
{

    // عرض تفاصيل مشكلة معينة
    public function show($id)
    {
        $problem = Problem::find($id);
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
        $request->validate(
            [
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
        $problem =  Problem::create([
            'user_id'     => Auth::id(), // المستخدم الحالي
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imagePath,
            'priority'    => $request->priority,
            'location'    => $request->location,
            'status'      => 'open', // الحالة تبدأ كـ "مفتوحة"
        ]);


        // تقسيم العنوان إلى كلمات
        $keywords = explode(' ', $request->title);

        // البحث عن الفئات التي تتطابق مع أي كلمة من العنوان
        $matchedCategoryIds = Category::where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->orWhere('name', 'like', '%' . $keyword . '%');
            }
        })->pluck('id');

        // إذا لم يتم العثور على فئات متطابقة
        if ($matchedCategoryIds->isEmpty()) {
            return redirect()->route('my.problems')->with('success', 'تم إنشاء المشكلة بنجاح!');
        }

        // البحث عن الحرفيين بناءً على معرفات الفئات المتطابقة
        $artisans = Artisan::whereHas('categories', function ($query) use ($matchedCategoryIds) {
            $query->whereIn('categories.id', $matchedCategoryIds);
        })->distinct()->get();

        // إعداد الرسالة
        $message = "هناك مشكلة قد تهمك: {$problem->title}";

        // إذا وُجد حرفيون
        if ($artisans->isNotEmpty()) {
            $notifications = $artisans->map(function ($artisan) use ($problem, $message) {
                return [
                    'problem_id' => $problem->id,
                    'user_id' => $artisan->user_id,
                    'message' => $message,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();

            Notification::insert($notifications);

            foreach ($artisans as $artisan) {
                event(new BroadCast($artisan->user_id, $message));
            }
        }



        return redirect()->route('my.problems')->with('success', 'تم إنشاء المشكلة بنجاح!');
    }
    /**
     * Display the specified resource.
     */



    public function myproblems()
    {

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
