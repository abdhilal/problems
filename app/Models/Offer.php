<?php

namespace App\Models;
use App\Services\NotificationService;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'artisan_id', 'problem_id', 'price', 'description', 'status', 'urgent'
    ];

    /**
     * علاقة العرض مع الحرفي الذي قدمه
     */
    public function artisan()
    {
        return $this->belongsTo(Artisan::class);
    }

    /**
     * علاقة العرض مع المشكلة
     */
    public function problem()
    {
        return $this->belongsTo(Problem::class);
    }

    /**
     * علاقة العرض مع المدفوعات
     */
    // public function payments()
    // {
    //     return $this->hasMany(Payment::class);
    // }
}
