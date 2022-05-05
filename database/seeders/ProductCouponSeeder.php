<?php

namespace Database\Seeders;

use App\Models\ProductCoupon;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCoupon::create([
            'code'                 => 'BOBK200',
            'type'                 => 'fixed',
            'value'                => 200,
            'description'          => "Discount 200 TL on your sales on website",
            'use_times'            => 20,
            'start_date'           => Carbon::now(),
            'expire_date'          => Carbon::now()->addMonth(),
            'status'               => 1,
            'greater_than'         => 600,
        ]);
        ProductCoupon::create([
            'code'                 => 'FIFTYFIFTY',
            'type'                 => 'percentage',
            'value'                => 50,
            'description'          => "Discount 50% on your sales on website",
            'use_times'            => 5,
            'start_date'           => Carbon::now(),
            'status'               => 1,
            'expire_date'          => Carbon::now()->addWeek(),
            'greater_than'         => null,
        ]);
    }
}
