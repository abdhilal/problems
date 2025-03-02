<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     // علاقة Many-to-Many مع الحرفيين
     public function artisans()
     {
         return $this->belongsToMany(Artisan::class, 'artisan_category');
     }
}
