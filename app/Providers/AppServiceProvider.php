<?php

namespace App\Providers;

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
                \App\Models\LabResult::where('practice_id', auth()->user()->practice_id)
                                ->select('farmer_name')
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
        //
    }
}
