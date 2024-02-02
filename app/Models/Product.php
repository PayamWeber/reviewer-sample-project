<?php

namespace App\Models;

use App\Models\Enums\ProductReviewableType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property ProductReviewableType $reviewable_type
 */
class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'price',
        'active',
        'vote',
        'reviewable_type',
        'price',
        'creator_id',
        'provider_id',
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'id',
        'title',
        'price',
        'active',
        'vote',
        'reviewable_type',
        'provider',
        'reviews',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'reviewable_type' => ProductReviewableType::class
    ];

    /**
     * @return BelongsTo
     */
    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    /**
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * @return HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'product_id');
    }
}
