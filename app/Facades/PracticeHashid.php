<?php

namespace App\Facades;

use App\Helpers\PracticeIdGenerator;
use Illuminate\Support\Facades\Facade;

class PracticeHashid extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     */
    protected static function getFacadeAccessor()
    {
        return PracticeIdGenerator::class;
    }

}
