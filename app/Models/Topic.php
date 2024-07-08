<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'topics';

    protected $fillable = ['id','name','course_id'];

    /**
     * @return BelongsTo<Course, Topic>
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    /**
     * @return HasMany<Lesson>
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * @return HasMany<Questions>
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Questions::class);
    }

     /**
     * @return HasMany<Results>
     */
    public function results(): HasMany
    {
        return $this->hasMany(Results::class);
    }
}
