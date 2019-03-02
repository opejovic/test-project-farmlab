<?php

namespace App\Helpers;

class LabResultHashidGenerator implements LabResultIdGenerator
{
    private $hashids;
    
    /**
     * Create a new hashids instance.
     *
     * @param string $salt
     *
     * @return void
     */	
	public function __construct($salt)
	{
		$this->hashids = new \Hashids\Hashids($salt, 8, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
	}
	
	/**
     * Encode lab result id to generate a hash.
     *
     * @param $labResult
     *
     * @return string
     */
	public function generateFor($labResult)
	{
		return $this->hashids->encode($labResult->id);
	}
}
