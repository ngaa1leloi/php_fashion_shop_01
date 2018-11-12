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
        view()->composer('layout.header', function($view)
        {
            $category = Category::where('priority', '1')->get();
            $view->with('category', $category);
        });

        view()->composer('layout.menu', function($view)
        {
            $category_male = Category::where(['priority' => '1', 'parent_id' => '1'])->get();
            $view->with('category_male', $category_male);
        });

        view()->composer('layout.menu', function($view)
        {
            $category_female = Category::where(['priority' => '1', 'parent_id' => '2'])->get();
            $view->with('category_female', $category_female);
        });

        view()->composer('layout.menu', function($view)
        {
            $category_child = Category::where('priority', '2')->get();
            $view->with('category_child', $category_child);
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
