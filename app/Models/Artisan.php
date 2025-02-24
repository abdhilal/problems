<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artisan extends Model
{
    protected $fillable = [
        'user_id', 'profession', 'experience_years', 'location'
    ];

    /**
     * علاقة الحرفي مع المستخدم
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * علاقة الحرفي مع العروض التي يقدمها
     */
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    /**
     * علاقة الحرفي مع التقييمات
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
