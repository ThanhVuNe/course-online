<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

class Survey extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'languages',
        'level',
    ];

    /**
     * @return BelongsTo<User, Survey>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return HasMany<Category>
     */
    public function categories()
    {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }

    /**
     * Scope the query to filter courses by languages.
     *
     * @param  Builder  $query
     * @param  int  $userId
     * @return Builder
     */
    public function scopeOwner($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
