<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Processing extends Model
{
    use HasFactory;

    protected $table = 'processing';

    protected $fillable = [
        'user_id',
        'lesson_id',
    ];

    /**
     * @return BelongsTo<User, Review>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo<Lesson, Review>
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }
}
