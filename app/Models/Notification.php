<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'message',
        'read_at',
    ];

    /**
     * علاقة الإشعارات مع المستخدم
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
