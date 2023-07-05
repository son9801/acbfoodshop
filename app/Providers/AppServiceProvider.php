<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        $webSetting = Setting::first();
        view()->share('appSetting', $webSetting);

        $navCategories = Category::where('status', '1')->get();
        view()->share('navBarCategories',$navCategories);
        
    }
}   
