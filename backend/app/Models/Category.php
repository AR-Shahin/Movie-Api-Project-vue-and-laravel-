<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, HasEagerLimit;
    protected $fillable = ['name', 'slug', 'image'];

    public function movies(): HasMany
    {
        return $this->hasMany(Movie::class)->latest()->take(2);
    }

    public function test()
    {
        return $this->hasMany(Movie::class);
    }
}
