<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Questions extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'topic_id',
        'title',
    ];

    /**
     * @return BelongsTo<Topic>
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }

      /**
     * @return HasMany<Answer>
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answers::class, 'question_id');
    }
}
