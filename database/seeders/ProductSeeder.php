<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $categories = ProductCategory::whereNotNull('parent_id')->pluck('id');
        $products = [];

        for ($i = 1; $i <= 1000; $i++) {
            $name = $faker->unique()->sentence(2, true);
            $products[] = [
                'name'                  => $name,
                'slug'                  => Str::slug($name),
                'description'           => $faker->paragraph,
                'price'                 => $faker->numberBetween(5, 200),
                'quantity'              => $faker->numberBetween(10, 100),
                'product_category_id'   => $categories->random(),
                'featured'              => rand(0, 1),
                'status'                => true,
                'created_at'            => now(),
                'updated_at'            => now(),
            ];
        }

        $chunks = array_chunk($products, 100);

        foreach ( $chunks as $chunk ) {
            Product::insert($chunk);
        }
    }
}
