<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Results extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'topic_id',
        'correct',
        'created_at'
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
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }
}
