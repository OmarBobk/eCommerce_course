<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function status() : string
    {
        return $this->status ? "Active" : "Inactive";
    }

    public function featured(): string
    {
        return $this->featured ? "Yes" : "No";
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_category_id', 'id');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function firstMedia(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediaable')->orderBy('file_sort', 'asc');
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediaable');
    }

}
