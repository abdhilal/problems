<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
*/
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'role', 'profile_image', 'bio'
    ];

    /**
     * علاقة المستخدم مع الحرفيين
     */
    public function artisan()
    {
        return $this->hasOne(Artisan::class);
    }

    /**
     * علاقة المستخدم مع المشاكل التي ينشرها
     */
    public function problems()
    {
        return $this->hasMany(Problem::class);
    }

    /**
     * علاقة المستخدم مع التقييمات
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * علاقة المستخدم مع المدفوعات
     */
    // public function payments()
    // {
    //     return $this->hasMany(Payment::class);
    // }

    /**
     * علاقة المستخدم مع الإشعارات
     */
    // public function notifications()
    // {
    //     return $this->hasMany(Notification::class);
    // }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

       // العلاقة مع الرسائل المرسلة
       public function sentMessages()
       {
           return $this->hasMany(Message::class, 'sender_id');
       }

       // العلاقة مع الرسائل المستلمة
       public function receivedMessages()
       {
           return $this->hasMany(Message::class, 'receiver_id');
       }

       public function notifications()
       {
        return $this->hasMany(Notification::class);

       }



}
