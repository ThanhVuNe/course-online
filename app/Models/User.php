<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\ActiveUserEnum;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'username',
        'email',
        'password',
        'is_active',
        'role_id',
        'token_authentication',
    ];

    protected $attributes = [
        'is_active' => 0,
        'role_id' => 1,
        'token_authentication' => ''
    ];

    protected $casts = [
        'role_id' => UserRoleEnum::class,
        'is_active' => ActiveUserEnum::class
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<\App\Models\Profile>
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    /**
     * @return HasOne<Survey>
     */
    public function survey(): HasOne
    {
        return $this->hasOne(Survey::class, 'user_id');
    }

    /**
     * @return HasMany<Cart>
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'user_id');
    }

    /**
     * @return HasMany<Course>
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    /**
     * @return HasMany<Order>
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    /**
     * @return HasMany<Enrollment>
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'user_id');
    }

    /**
     * @return HasMany<Comment>
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * @return HasMany<Review>
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'user_id');
    }
}
