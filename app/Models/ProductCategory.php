<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function parent(): HasOne
    {
        return $this->hasOne(ProductCategory::class, 'id', 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(ProductCategory::class, 'parent_id', 'id');
    }

    public function appeardChildren(): HasMany
    {
        return $this->hasMany(ProductCategory::class, 'parent_id', 'id')
            ->where('status', true);
    }

    public static function tree( $level = 1 )
    {
        return static::with(implode('.', array_fill(0, $level, 'children')))
            ->whereNull('parent_id')
            ->whereStatus(true)
            ->orderBy('id', 'asc')
            ->get();
    }

}
