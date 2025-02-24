<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id', 'artisan_id', 'rating', 'comment'
    ];

    /**
     * علاقة التقييم مع المستخدم
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * علاقة التقييم مع الحرفي
     */
    public function artisan()
    {
        return $this->belongsTo(Artisan::class);
    }
}
