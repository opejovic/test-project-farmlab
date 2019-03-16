<?php

namespace App\Providers;

use App\Helpers\HashidGenerator;
use App\Helpers\InvitationCodeGenerator;
use App\Helpers\LabResultHashidGenerator;
use App\Helpers\LabResultIdGenerator;
use App\Helpers\RandomCodeGenerator;
use App\Helpers\UserIdGenerator;
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
        $this->app->bind(InvitationCodeGenerator::class, RandomCodeGenerator::class);
        
        $this->app->bind(LabResultIdGenerator::class, function () {
            return new HashidGenerator(config('app.labresult_id_salt'));
        });

        $this->app->bind(UserIdGenerator::class, function () {
            return new HashidGenerator(config('app.user_id_salt'));
        });        
    }
}
