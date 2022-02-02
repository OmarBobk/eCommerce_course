<?php

namespace Database\Seeders;

use App\Models\Permission;
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

        for ($i = 1; $i <= 20; $i++) {
            $random_customer = User::create([
                'username' => $faker->userName,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName, 'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'mobile' => '966500' . $faker->numberBetween(10000, 99999), 'password' => bcrypt('123'), 'user_image' => 'avatar.svg', 'status' => 1, 'remember_token' => Str::random(10),]);

            $random_customer->attachRole($customerRole);
        }

        $manageMain = Permission::create(
            [
                'name' => 'main',
                'display_name' => 'Main',
                'route' => 'index',
                'module' => 'index',
                'as' => 'index',
                'icon' => 'fas fa-home',
                'parent' => '0',
                'parent_original' => '0',
                'sidebar_link' => '1',
                'appear' => '1',
                'ordering' => '1',
            ]);
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();

        // Products Categories
        $manageProductCategories = Permission::create(
            [
                'name'            => 'manage_product_categories',
                'display_name'    => 'Category',
                'route'           => 'product_categories',
                'module'          => 'product_categories',
                'as'              => 'product_categories.index',
                'icon'            => 'fas fa-file-archive',
                'parent'          => '0',
                'parent_original' => '0',
                'sidebar_link'    => '1',
                'appear'          => '1',
                'ordering'        => '5',
            ]);
        $manageProductCategories->parent_show = $manageProductCategories->id;
        $manageProductCategories->save();

        $showProductCategories = Permission::create(
            [
                'name'            => 'show_product_categories',
                'display_name'    => 'Category',
                'route'           => 'product_categories',
                'module'          => 'product_categories',
                'as'              => 'product_categories.index',
                'icon'            => 'fas fa-file-archive',
                'parent'          => $manageProductCategories->id,
                'parent_original' => $manageProductCategories->id,
                'parent_show'     => $manageProductCategories->id,
                'sidebar_link'    => '1',
                'appear'          => '1',
            ]);

        $createProductCategories = Permission::create(
            [
                'name'            => 'create_product_categories',
                'display_name'    => 'Create Category',
                'route'           => 'product_categories',
                'module'          => 'product_categories',
                'as'              => 'product_categories.create',
                'icon'            => null,
                'parent'          => $manageProductCategories->id,
                'parent_original' => $manageProductCategories->id,
                'parent_show'     => $manageProductCategories->id,
                'sidebar_link'    => '1',
                'appear'          => '0',
            ]);

        $displayProductCategories = Permission::create(
            [
                'name'            => 'display_product_categories',
                'display_name'    => 'Show Category',
                'route'           => 'product_categories',
                'module'          => 'product_categories',
                'as'              => 'product_categories.show',
                'icon'            => null,
                'parent'          => $manageProductCategories->id,
                'parent_original' => $manageProductCategories->id,
                'parent_show'     => $manageProductCategories->id,
                'sidebar_link'    => '1',
                'appear'          => '0',
            ]);

        $updateProductCategories = Permission::create(
            [
                'name'            => 'update_product_categories',
                'display_name'    => 'Update Category',
                'route'           => 'product_categories',
                'module'          => 'product_categories',
                'as'              => 'product_categories.edit',
                'icon'            => null,
                'parent'          => $manageProductCategories->id,
                'parent_original' => $manageProductCategories->id,
                'parent_show'     => $manageProductCategories->id,
                'sidebar_link'    => '1',
                'appear'          => '0',
            ]);

        $deleteProductCategories = Permission::create(
            [
                'name'            => 'delete_product_categories',
                'display_name'    => 'Delete Category',
                'route'           => 'product_categories',
                'module'          => 'product_categories',
                'as'              => 'product_categories.destroy',
                'icon'            => null,
                'parent'          => $manageProductCategories->id,
                'parent_original' => $manageProductCategories->id,
                'parent_show'     => $manageProductCategories->id,
                'sidebar_link'    => '1',
                'appear'          => '0',
            ]);

        // Tag
        $manageTags = Permission::create(
            [
                'name'            => 'manage_tags',
                'display_name'    => 'Tag',
                'route'           => 'tags',
                'module'          => 'tags',
                'as'              => 'tags.index',
                'icon'            => 'fas fa-tags',
                'parent'          => '0',
                'parent_original' => '0',
                'sidebar_link'    => '1',
                'appear'          => '1',
                'ordering'        => '10',
            ]);
        $manageTags->parent_show = $manageTags->id;
        $manageTags->save();

        $showTags = Permission::create(
            [
                'name'            => 'show_tags',
                'display_name'    => 'Tag',
                'route'           => 'tags',
                'module'          => 'tags',
                'as'              => 'tags.index',
                'icon'            => 'fas fa-tags',
                'parent'          => $manageTags->id,
                'parent_original' => $manageTags->id,
                'parent_show'     => $manageTags->id,
                'sidebar_link'    => '1',
                'appear'          => '1',
            ]);

        $createTags = Permission::create(
            [
                'name'            => 'create_tags',
                'display_name'    => 'Create Tag',
                'route'           => 'tags',
                'module'          => 'tags',
                'as'              => 'tags.create',
                'icon'            => null,
                'parent'          => $manageTags->id,
                'parent_original' => $manageTags->id,
                'parent_show'     => $manageTags->id,
                'sidebar_link'    => '1',
                'appear'          => '0',
            ]);

        $displayTags = Permission::create(
            [
                'name'            => 'display_tags',
                'display_name'    => 'Show Tag',
                'route'           => 'tags',
                'module'          => 'tags',
                'as'              => 'tags.show',
                'icon'            => null,
                'parent'          => $manageTags->id,
                'parent_original' => $manageTags->id,
                'parent_show'     => $manageTags->id,
                'sidebar_link'    => '1',
                'appear'          => '0',
            ]);

        $updateTags = Permission::create(
            [
                'name'            => 'update_tags',
                'display_name'    => 'Update Tag',
                'route'           => 'tags',
                'module'          => 'tags',
                'as'              => 'tags.edit',
                'icon'            => null,
                'parent'          => $manageTags->id,
                'parent_original' => $manageTags->id,
                'parent_show'     => $manageTags->id,
                'sidebar_link'    => '1',
                'appear'          => '0',
            ]);

        $deleteTags = Permission::create(
            [
                'name'            => 'delete_tags',
                'display_name'    => 'Delete Tag',
                'route'           => 'tags',
                'module'          => 'tags',
                'as'              => 'tags.destroy',
                'icon'            => null,
                'parent'          => $manageTags->id,
                'parent_original' => $manageTags->id,
                'parent_show'     => $manageTags->id,
                'sidebar_link'    => '1',
                'appear'          => '0',
            ]);

        // Product
        $manageProducts = Permission::create(
            [
                'name'            => 'manage_products',
                'display_name'    => 'Product',
                'route'           => 'products',
                'module'          => 'products',
                'as'              => 'products.index',
                'icon'            => 'fas fa-file-archive',
                'parent'          => '0',
                'parent_original' => '0',
                'sidebar_link'    => '1',
                'appear'          => '1',
                'ordering'        => '10',
            ]);
        $manageProducts->parent_show = $manageProducts->id;
        $manageProducts->save();

        $showProducts = Permission::create(
            [
                'name'            => 'show_products',
                'display_name'    => 'Product',
                'route'           => 'products',
                'module'          => 'products',
                'as'              => 'products.index',
                'icon'            => 'fas fa-file-archive',
                'parent'          => $manageProducts->id,
                'parent_original' => $manageProducts->id,
                'parent_show'     => $manageProducts->id,
                'sidebar_link'    => '1',
                'appear'          => '1',
            ]);

        $createProducts = Permission::create(
            [
                'name'            => 'create_products',
                'display_name'    => 'Create Product',
                'route'           => 'products',
                'module'          => 'products',
                'as'              => 'products.create',
                'icon'            => null,
                'parent'          => $manageProducts->id,
                'parent_original' => $manageProducts->id,
                'parent_show'     => $manageProducts->id,
                'sidebar_link'    => '1',
                'appear'          => '0',
            ]);

        $displayProducts = Permission::create(
            [
                'name'            => 'display_products',
                'display_name'    => 'Show Product',
                'route'           => 'products',
                'module'          => 'products',
                'as'              => 'products.show',
                'icon'            => null,
                'parent'          => $manageProducts->id,
                'parent_original' => $manageProducts->id,
                'parent_show'     => $manageProducts->id,
                'sidebar_link'    => '1',
                'appear'          => '0',
            ]);

        $updateProducts = Permission::create(
            [
                'name'            => 'update_products',
                'display_name'    => 'Update Product',
                'route'           => 'products',
                'module'          => 'products',
                'as'              => 'products.edit',
                'icon'            => null,
                'parent'          => $manageProducts->id,
                'parent_original' => $manageProducts->id,
                'parent_show'     => $manageProducts->id,
                'sidebar_link'    => '1',
                'appear'          => '0',
            ]);

        $deleteProducts = Permission::create(
            [
                'name'            => 'delete_products',
                'display_name'    => 'Delete Product',
                'route'           => 'products',
                'module'          => 'products',
                'as'              => 'products.destroy',
                'icon'            => null,
                'parent'          => $manageProducts->id,
                'parent_original' => $manageProducts->id,
                'parent_show'     => $manageProducts->id,
                'sidebar_link'    => '1',
                'appear'          => '0',
            ]);

    }
}
