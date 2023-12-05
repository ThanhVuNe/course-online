<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'lesson_id',
        'user_id',
        'parent_id',
        'content'
    ];

    /**
     * @return BelongsTo<User, Comment>
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo<Lesson, Comment>
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
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
