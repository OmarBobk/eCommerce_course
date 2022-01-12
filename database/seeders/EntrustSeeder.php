<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        // Roles
        $adminRole = Role::create(['name' => 'admin', 'display_name' => 'Adminstration', 'description' => 'Adminstrator', 'allowed_route' => 'admin']);
        $supervisorRole = Role::create(['name' => 'supervisor', 'display_name' => 'Supervisor', 'description' => 'Supervisor', 'allowed_route' => 'admin']);
        $customerRole = Role::create(['name' => 'customer', 'display_name' => 'Customer', 'description' => 'Customer', 'allowed_route' => null]);

        // Users
        $admin = User::create(['username' => 'admin', 'first_name' => 'Admin', 'last_name' => 'System', 'email' => 'admin@dev.test', 'email_verified_at' => now(), 'mobile' => '96650000000', 'password' => bcrypt('123'), 'user_image' => 'avatar.svg', 'status' => 1, 'remember_token' => Str::random(10),]);
        // This will create new record in user_role table
        $admin->attachRole($adminRole);

        $supervisor = User::create(['username' => 'supervisor', 'first_name' => 'Supervisor', 'last_name' => 'System', 'email' => 'supervisor@dev.test', 'email_verified_at' => now(), 'mobile' => '96650300000', 'password' => bcrypt('123'), 'user_image' => 'avatar.svg', 'status' => 1, 'remember_token' => Str::random(10),]);
        $supervisor->attachRole($supervisorRole);

        $customer = User::create(['username' => 'customer', 'first_name' => 'Customer 1', 'last_name' => 'Customer Last Name', 'email' => 'customer@dev.test', 'email_verified_at' => now(), 'mobile' => '96652300000', 'password' => bcrypt('123'), 'user_image' => 'avatar.svg', 'status' => 1, 'remember_token' => Str::random(10),]);
        $customer->attachRole($customerRole);

        for($i = 1; $i <= 20; $i++) {
            $random_customer = User::create([
                'username'   => $faker->userName,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName, 'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'mobile' => '966500' . $faker->numberBetween(10000, 99999), 'password' => bcrypt('123'), 'user_image' => 'avatar.svg', 'status' => 1, 'remember_token' => Str::random(10),]);

            $random_customer->attachRole($customerRole);
        }

    }
}
