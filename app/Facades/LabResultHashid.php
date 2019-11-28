<?php

namespace App\Facades;

use App\Helpers\LabResultIdGenerator;
use Illuminate\Support\Facades\Facade;

class LabResultHashid extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return LabResultIdGenerator::class;
    }

}
