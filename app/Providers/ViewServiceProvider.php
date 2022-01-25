<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(request()->is('admin/*')) {

            view()->composer('*', function ($view) {
                // Create New Cache if it is not exists.
                if (!Cache::has('admin_side_menu')) {
                    Cache::forever('admin_side_menu', Permission::tree());
                }

                // Or get it
                $view->with([
                    'admin_side_menu' => Cache::get('admin_side_menu'),
                ]);
            });
        }
    }
}
