<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $clothes = ProductCategory::create([
            'name' => 'Clothes',
            'slug' => Str::slug('Clothes'),
            'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => null]);
        ProductCategory::create([
            'name' => 'Women\'s T-Shirts',
            'slug' => Str::slug('Women\'s T-Shirts'),
            'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategory::create([
            'name' => 'Men\'s T-Shirts',
            'slug' => Str::slug('Men\'s T-Shirts'),
            'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategory::create([
            'name' => 'Dresses',
            'slug' => Str::slug('Dresses'),
            'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategory::create([
            'name' => 'Novelty socks',
            'slug' => Str::slug('Novelty socks'),
            'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategory::create([
            'name' => 'Women\'s sunglasses',
            'slug' => Str::slug('Women\'s sunglasses'),
            'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategory::create([
            'name' => 'Men\'s sunglasses',
            'slug' => Str::slug('Men\'s sunglasses'),
            'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);

        $shoes = ProductCategory::create([
            'name' => 'Shoes',
            'slug' => Str::slug('Shoes'),
            'cover' => 'shoes.jpg', 'status' => true]);
        ProductCategory::create([
            'name' => 'Women\'s Shoes',
            'slug' => Str::slug('Women\'s Shoes'),
            'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id]);
        ProductCategory::create([
            'name' => 'Men\'s Shoes',
            'slug' => Str::slug('Men\'s Shoes'),
            'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id]);
        ProductCategory::create([
            'name' => 'Boy\'s Shoes',
            'slug' => Str::slug('Boy\'s Shoes'),
            'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id]);
        ProductCategory::create([
            'name' => 'Girls\'s Shoes',
            'slug' => Str::slug('Girls\'s Shoes'),
            'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id]);

        $watches = ProductCategory::create([
            'name' => 'Watches',
            'slug' => Str::slug('Watches'),
            'cover' => 'watches.jpg', 'status' => true]);
        ProductCategory::create([
            'name' => 'Women\'s Watches',
            'slug' => Str::slug('Women\'s Watches'),
            'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $watches->id]);
        ProductCategory::create([
            'name' => 'Men\'s Watches',
            'slug' => Str::slug('Men\'s Watches'),
            'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $watches->id]);
        ProductCategory::create([
            'name' => 'Boy\'s Watches',
            'slug' => Str::slug('Boy\'s Watches'),
            'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $watches->id]);
        ProductCategory::create([
            'name' => 'Girls\'s Watches',
            'slug' => Str::slug('Girls\'s Watches'),
            'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $watches->id]);

        $electronics = ProductCategory::create([
            'name' => 'Electronics',
            'slug' => Str::slug('Electronics'),
            'cover' => 'electronics.jpg', 'status' => true]);
        ProductCategory::create([
            'name' => 'Electronics 1',
            'slug' => Str::slug('Electronics 1'),
            'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategory::create([
            'name' => 'USB Flash drives',
            'slug' => Str::slug('USB Flash drives'),
            'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategory::create([
            'name' => 'Headphones',
            'slug' => Str::slug('Headphones'),
            'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategory::create([
            'name' => 'Portable speakers',
            'slug' => Str::slug('Portable speakers'),
            'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategory::create([
            'name' => 'Cell Phone bluetooth headsets',
            'slug' => Str::slug('Cell Phone bluetooth headsets'),
            'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategory::create([
            'name' => 'Keyboards',
            'slug' => Str::slug('Keyboards'),
            'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);


    }
}
