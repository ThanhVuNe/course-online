<?php

namespace App\Models;

use AmazonS3;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'courses';

    protected $fillable = [
        'title',
        'introduction',
        'price',
        'discount',
        'category_id',
        'instructor_id',
        'trailer_url',
        'average_rating',
        'num_reviews',
        'total_students',
        'total_lessons',
        'languages',
        'level',
        'poster_url',
        'total_time',
        'description',
        'learns_description',
        'requirements_description',
        'is_active',
    ];

    protected $attributes = [
        'trailer_url' => '',
        'poster_url' => '',
        'average_rating' => 0,
        'num_reviews' => 0,
        'discount' => 0,
        'total_students' => 0,
        'total_lessons' => 0,
        'total_time' => 0,
        'is_active' => 'false'
    ];

    private const VIDEO_DURATION_EXTRA_SHORT = 1;
    private const VIDEO_DURATION_SHORT = 3;
    private const VIDEO_DURATION_MEDIUM = 6;
    private const VIDEO_DURATION_LONG = 17;

    /**
     * @return BelongsTo<Category, Course>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @return HasMany<Topic>
     */
    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }

    /**
     * @return float
     */
    public function getDiscountedPriceAttribute()
    {
        return $this->price * (1 - $this->discount / 100);
    }

    /**
     * @return string
     */
    public function getLanguageAttribute()
    {
        return match ((int) $this->languages) {
            1 => __('english_lang'),
            2 => __('vietnamese_lang'),
            default => '',
        };
    }

    /**
     * @return string
     */
    public function getLevelCourseAttribute()
    {
        return  match ((int) $this->level) {
            1 => __('beginner_level'),
            2 => __('intermediate_level'),
            3 => __('advanced_level'),
            default => '',
        };
    }

    /**
     * @return HasMany<Cart>
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'course_id', 'id');
    }

    /**
     * @return HasMany<Review>
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'course_id');
    }

    /**
     * @return HasMany<Order>
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'course_id', 'id');
    }

    /**
     * @return HasMany<Enrollment>
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'course_id', 'id');
    }

     /**
     * @return HasMany<Favorites>
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class, 'course_id', 'id');
    }

    /**
     * @return BelongsTo<User, Course>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id ', 'id');
    }

    /**
     * Scope the query to filter courses by category.
     *
     * @param  Builder  $query
     * @param  array  $category
     * @return Builder
     */
    public function scopeFilterByCategory(Builder $query, array $category): Builder
    {
        return $query->whereIn('category_id', $category);
    }

    /**
     * Scope the query to filter courses by search term.
     *
     * @param  Builder  $query
     * @param  string  $searchTerm
     * @return Builder
     */
    public function scopeFilterBySearchTerm(Builder $query, string $searchTerm): Builder
    {
        return $query->where(function (Builder $query) use ($searchTerm) {
            $query->where('title', 'like', "%$searchTerm%")
                ->orWhere('description', 'like', "%$searchTerm%")
                ->orWhere('learns_description', 'like', "%$searchTerm%");
        });
    }

    /**
     * Scope the query to filter courses by minimum rating.
     *
     * @param  Builder  $query
     * @param  float  $rating
     * @return Builder
     */
    public function scopeFilterByRating(Builder $query, float $rating): Builder
    {
        return $query->where('average_rating', '>=', $rating);
    }

    /**
     * Scope the query to filter courses by languages.
     *
     * @param  Builder  $query
     * @param  array  $languages
     * @return Builder
     */
    public function scopeFilterByLanguage(Builder $query, array $languages): Builder
    {
        return $query->whereIn('languages', $languages);
    }

    /**
     * Scope the query to filter courses by level.
     *
     * @param  Builder  $query
     * @param  array  $levels
     * @return Builder
     */
    public function scopeFilterByLevel(Builder $query, array $levels): Builder
    {
        return $query->whereIn('level', $levels);
    }

    /**
     * Scope the query to filter courses by price.
     *
     * @param  Builder  $query
     * @param  string  $price
     * @return Builder
     */
    public function scopeFilterByPrice(Builder $query, string $price): Builder
    {
        if ($price === 'free') {
            return $query->where('price', 0);
        } elseif ($price === 'paid') {
            return $query->where('price', '>', 0);
        }
        return $query;
    }

    /**
     * Scope the query to filter courses by duration.
     *
     * @param  Builder  $query
     * @param  array  $durations
     * @return Builder
     */
    public function scopeFilterByDuration(Builder $query, array $durations): Builder
    {
        return $query->where(function (Builder $query) use ($durations) {
            $query->when(in_array('extraShort', $durations), function ($query) {
                $query->orWhere('total_time', '<=', self::VIDEO_DURATION_EXTRA_SHORT);
            });

            $query->when(in_array('short', $durations), function ($query) {
                $query->orWhere(function (Builder $query) {
                    $query->where('total_time', '>', self::VIDEO_DURATION_EXTRA_SHORT)
                        ->where('total_time', '<=', self::VIDEO_DURATION_SHORT);
                });
            });

            $query->when(in_array('medium', $durations), function ($query) {
                $query->orWhere(function (Builder $query) {
                    $query->where('total_time', '>', self::VIDEO_DURATION_SHORT)
                        ->where('total_time', '<=', self::VIDEO_DURATION_MEDIUM);
                });
            });

            $query->when(in_array('long', $durations), function ($query) {
                $query->orWhere(function (Builder $query) {
                    $query->where('total_time', '>', self::VIDEO_DURATION_MEDIUM)
                        ->where('total_time', '<=', self::VIDEO_DURATION_LONG);
                });
            });

            $query->when(in_array('extraLong', $durations), function ($query) {
                $query->orWhere('total_time', '>', self::VIDEO_DURATION_LONG);
            });
        });
    }

    /**
     * poster get from s3
     * @param string $value
     *
     * @return string
     */
    public function getPosterUrlAttribute($value)
    {
        return AmazonS3::getObjectUrl($value);
    }

    /**
     * trailer get from s3
     * @param string $value
     *
     * @return string
     */
    public function getTrailerUrlAttribute($value)
    {
        return AmazonS3::getObjectUrl($value);
    }
}
