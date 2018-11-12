<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layout.header', function($view){
            $category = Category::where('priority', '1')->get();
            $view->with('category', $category);
        });

        view()->composer('layout.menu', function($view){
            $category1 = Category::where(['priority' => '1', 'parent_id' => '1'])->get();
            $view->with('category1', $category1);
        });

        view()->composer('layout.menu', function($view){
            $category2 = Category::where(['priority' => '1', 'parent_id' => '2'])->get();
            $view->with('category2', $category2);
        });

        view()->composer('layout.menu', function($view){
            $category3 = Category::where('priority', '2')->get();
            $view->with('category3', $category3);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
