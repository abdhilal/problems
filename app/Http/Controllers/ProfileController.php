<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Artisan;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{


    public function show()
    {

        $user = Auth::user();
        return view('profile.show', compact('user',));
    }
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        $categories = Category::all();
        $user = Auth::user();
        return view('profile.edit', compact(['user', 'categories']));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {




        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
        }

        $imagePath = null;
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile', 'public');
            Auth::user()->profile_image = $imagePath; // تحديث حقل الصورة في قاعدة البيانات
        }
        $request->user()->save();

       
        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
