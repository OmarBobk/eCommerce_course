<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProductsTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::whereStatus(true)->pluck('id')->toArray();

        Product::all()->each(function ($product) use ($tags) {
            // This array will contain more than one tag.
            $tagsToAttach = Arr::random($tags, rand(2, 3));
            $product->tags()->attach($tagsToAttach);
        });
    }
}
