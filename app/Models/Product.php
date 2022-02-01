<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_category_id', 'id');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediaable');
    }

}
