<?php

namespace App\Helpers;

interface LabResultIdGenerator
{
	/**
     * Generate a hash for a given lab result.
     *
     * @param $labResult
     *
     * @return string
     */
    public function generateFor($labResult);
}
