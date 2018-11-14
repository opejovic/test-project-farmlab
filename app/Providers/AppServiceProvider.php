<?php

namespace App\Providers;

use DB;
use Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Passing $farmers variable to vets.dropdown view.  

        \View::composer('vets.dropdown', function ($view) {
            if (auth()->check()) {
            $view->with('farmers', 
                \App\Models\LabResult::select('farmer_name')
                                ->orderBy('farmer_name', 'asc')
                                ->distinct()
                                ->get());
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once __DIR__ . '/../Http/Helpers/Navigation.php';
    }
}
