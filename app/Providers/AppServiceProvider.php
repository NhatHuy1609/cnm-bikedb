<?php

namespace App\Providers;

use App\Services\GeneralCategoryService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{

    protected $generalCategoryService;

    public function __construct()
    {
        $this->generalCategoryService = new GeneralCategoryService(new \App\Models\Category);
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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() 
    {
        View::composer('*', function ($view) {
            $highestCategories = $this->generalCategoryService->getAllHighestLevelCategories();
            $view->with('highestCategories', $highestCategories);
        });
    }
}
