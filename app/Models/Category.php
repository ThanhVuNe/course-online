<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';
    protected $fillable = ['name'];

    /**
     * @return HasMany<Course>
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'category_id', 'id');
    }

    /**
     * @return BelongsTo<Survey, Category>
     */
    public function survey()
    {
        return $this->belongsTo(Survey::class, 'category_id', 'id');
    }
}
