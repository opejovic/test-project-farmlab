<?php

namespace App\Providers;

use App\Helpers\LabResultHashidGenerator;
use App\Helpers\LabResultIdGenerator;
use DB;
use Illuminate\Support\ServiceProvider;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LabResultHashidGenerator::class, function () {
            return new LabResultHashidGenerator(config('app.labresult_id_salt'));
        });

        $this->app->bind(LabResultIdGenerator::class, LabResultHashidGenerator::class);
    }
}
