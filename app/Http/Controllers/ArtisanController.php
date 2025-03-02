<?php

namespace App\Http\Controllers;

use App\Models\Artisan;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArtisanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $artisans = Artisan::with(['user', 'reviews'])->get();


        return view('artisans.index', compact('artisans'));
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
    public function show($id)
    {
        $artisan = Artisan::with(['user', 'reviews'])->findOrFail($id);
        return view('artisans.show', compact('artisan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artisan $artisan)
    {
        $categories = Category::all();
        $user = Auth::user();
        return view('profile.artisans.edit', compact(['user', 'categories']));
    }

    /**


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artisan $artisan)
    {
        //
    }

    public function update(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15'],
            'profession' => 'required_if:role,artisan|string|max:255|nullable',
            'experience_years' => 'required_if:role,artisan|integer|min:0|nullable',
            'address' => 'string|max:255|nullable',
        ]);
        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'bio' => $request->bio,
            'address' => $request->address,


        ]);
        $artisan = Auth::user()->artisan;

        $artisan->update([
            'profession' => $request->profession,
            'experience_years' => $request->experience_years,
        ]);

        // حفظ التصنيفات المختارة

        $artisan->categories()->sync($request->categories);


        return redirect()->route('profile-artisan.edit', $artisan)->with('success', 'تم تحديث التصنيفات بنجاح!');
    }
}
