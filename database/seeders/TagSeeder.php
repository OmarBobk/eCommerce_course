<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['name' => 'Clothes', 'slug' => Str::slug('Clothes'), 'status' => true]);
        Tag::create(['name' => 'Shoes', 'slug' => Str::slug('Shoes'), 'status' => true]);
        Tag::create(['name' => 'Watches', 'slug' => Str::slug('Watches'), 'status' => true]);
        Tag::create(['name' => 'Electronics', 'slug' => Str::slug('Electronics'), 'status' => true]);
        Tag::create(['name' => 'Men', 'slug' => Str::slug('Men'), 'status' => true]);
        Tag::create(['name' => 'Women', 'slug' => Str::slug('Women'), 'status' => true]);
        Tag::create(['name' => 'Boys', 'slug' => Str::slug('Boys'), 'status' => true]);
        Tag::create(['name' => 'Girls', 'slug' => Str::slug('Girls'), 'status' => true]);
    }
}
