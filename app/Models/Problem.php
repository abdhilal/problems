<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'image', 'priority', 'location', 'status'
    ];

    /**
     * علاقة المشكلة مع المستخدم الذي نشرها
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * علاقة المشكلة مع العروض التي قدمها الحرفيون
     */
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    /**
     * علاقة المشكلة مع الحرفي الذي تم اختياره لحلها
     */
    public function problemArtisans()
    {
        return $this->hasMany(ProblemArtisan::class);
    }
}
