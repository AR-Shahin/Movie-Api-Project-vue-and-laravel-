<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    BelongsTo,
    HasMany
};
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Movie extends Model
{
    use HasFactory, HasEagerLimit;
    protected $fillable = ['name', 'slug', 'image', 'category_id', 'description'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
