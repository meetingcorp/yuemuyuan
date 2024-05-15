<?php

namespace App\Providers;

use App\Models\ProductCategory;
use App\Models\Subproductcategorieses;
use Illuminate\Support\ServiceProvider;

class FrontendProvider extends ServiceProvider
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
        // $category = ProductCategory::where('publish', '=', 1)->orderBy('sort', 'asc')->get();
        // $subproduct = Subproductcategorieses::where('publish', '=', 1)->orderBy('sort', 'asc')->get();
        // view()->share('category', $category);
        // view()->share('subcategory', $subproduct);
    }
}
