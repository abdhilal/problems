<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['user_id', 'read_at', 'message','problem_id'];

    public function notifications()
       {
        return $this->belongsTo(User::class);
       }
}
