<?php

namespace App\Facades;

use App\Helpers\UserIdGenerator;
use Illuminate\Support\Facades\Facade;

class UserHashid extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return UserIdGenerator::class;
    }

}
