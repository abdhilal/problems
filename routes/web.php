<?php

use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Models\Problem;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/store', [ProfileController::class, 'update'])->name('profile.update');
});

// problems user
Route::get('/problems/create',[ProblemController::class,'create'])->name('problems.create');
Route::post('/problems',[ProblemController::class,'store'])->name('problems.store');

// عرض قائمة المشاكل
Route::get('/problems', [ProblemController::class, 'index'])->name('problems.index');
//عرض تفاصيل المشكلة
Route::get('/problems/{id}', [ProblemController::class, 'show'])->name('problems.show');

// تقديم عرض جديد
Route::post('/problems/{problem}/offers', [OfferController::class, 'store'])->name('offers.store');

// قبول عرض معين
Route::post('/problems/{problem}/offers/{offer}/accept', [OfferController::class, 'accept'])->name('offers.accept');
Route::post('/problems/{problem}/offers/{offer}/reject', [OfferController::class, 'reject'])->name('offers.reject');

Route::get('/artisans/{artisan}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');

// حفظ التقييم
Route::post('/artisans/{artisan}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
 //مشكلاتي
Route::get('/myproblems',[ProblemController::class,'myproblems'])->name('my.problems');

//الاشعارات
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

//تحديد الاشعار كمقروء
Route::post('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
//الصفحة الرئيسية
Route::get('home',[HomeController::class,'index'])->name('home.index');
//عرض الحرفيين
Route::get('/artisans',[ArtisanController::class,'index'])->name('artisans.index');
Route::get('/artisans/{id}',[ArtisanController::class,'show'])->name('artisans.show');

// عرض المحادثة وإرسال الرسائل
Route::get('/messages/{receiverId}', [MessageController::class, 'index'])->name('messages.index');
Route::post('/messages/{receiverId}', [MessageController::class, 'store'])->name('messages.store');

// تحديد الرسالة كمقروءة
Route::post('/messages/{message}/mark-as-read', [MessageController::class, 'markAsRead'])->name('messages.markAsRead');
//قائمة المحادثة
Route::get('/messages', [MessageController::class, 'conversations'])->name('messages.conversations');


require __DIR__.'/auth.php';
