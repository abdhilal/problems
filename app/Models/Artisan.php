<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Artisan extends Model
{

    protected $fillable = [
        'user_id', 'profession', 'experience_years', 'location','categories'
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

    // علاقة Many-to-Many مع التصنيفات
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'artisan_category');
    }
}
