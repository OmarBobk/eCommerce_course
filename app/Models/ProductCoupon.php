<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class ProductCoupon extends Model
{
    use HasFactory, SearchableTrait;


    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'product_coupons.code' => 10,
        ]
    ];


    protected $guarded = [];

    protected $dates = ['start_date', 'expire_date'];

    public function status(): string
    {
        return $this->status ? 'Active' : 'Inactive';
    }
}
