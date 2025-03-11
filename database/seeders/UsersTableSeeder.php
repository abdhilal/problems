<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Artisan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // إنشاء مستخدم
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => Faker::create()->phoneNumber(), // رقم هاتف عشوائي
            'address' => Faker::create()->address(), // عنوان عشوائي
            'role' => 'artisan', // تعيين قيمة role كـ 'artisan'
        ]);

        // إنشاء Artisan
        Artisan::create([
            'user_id' => 1,
            'profession' => 'سباكة',
            'experience_years' => 2,
        ]);

        // إدخال 10 مستخدمين عشوائيين باستخدام الفاكتوري
        \App\Models\User::factory(10)->create();
    }
}
