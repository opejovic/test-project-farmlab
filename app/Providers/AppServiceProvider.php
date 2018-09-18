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
        // Passing $farmers variable to layouts.nav view. 

        \View::composer('layouts.nav', function ($view) {
            if (auth()->check()) {
            $view->with('farmers', 
                \App\LabResult::where('practice_id', auth()->user()->practice_id)
                                ->select('farmer_name')
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
