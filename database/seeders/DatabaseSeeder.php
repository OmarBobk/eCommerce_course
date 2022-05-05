<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EntrustSeeder::class,
            ProductCategorySeeder::class,
            TagSeeder::class,
            ProductSeeder::class,
            ProductsImagesSeeder::class,
            ProductsTagsSeeder::class,
            ProductCouponSeeder::class,
        ]);
    }
}
