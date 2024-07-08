<?php

namespace App\Models;

use AmazonS3;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "lessons";

    protected $fillable = [
        'title',
        'lesson_duration',
        'topic_id',
        'lesson_url',
    ];

    protected $attributes = [
        'lesson_url' => '',
    ];

    /**
     * @return HasMany<Comment>
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'lesson_id');
    }

    /**
     * @return BelongsTo<Topic, Lesson>
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }

    /**
     * @return HasMany<Processing>
     */
    public function processing(): HasMany
    {
        return $this->hasMany(Processing::class, 'lesson_id');
    }

     /**
     * poster get from s3
     * @param string $value
     *
     * @return string
     */
    public function getLessonUrlAttribute($value)
    {
        return AmazonS3::getObjectUrl($value);
    }
}
