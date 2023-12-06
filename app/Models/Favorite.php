<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
    ];

     /**
     * @return BelongsTo<User, Favortite>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

     /**
     * @return BelongsTo<Course, Enrollment>
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

       /**
     * Scope the query to filter courses by languages.
     *
     * @param  Builder  $query
     * @param  array  $userId
     * @return Builder
     */
    public function scopeOwner($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
