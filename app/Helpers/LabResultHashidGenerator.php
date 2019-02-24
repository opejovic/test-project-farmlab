<?php

namespace App\Helpers;

class LabResultHashidGenerator implements LabResultIdGenerator
{
    private $hashids;
	
	public function __construct($salt)
	{
		$this->hashids = new \Hashids\Hashids($salt, 8, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
	}
	
	public function generateFor($labResult)
	{
		return $this->hashids->encode($labResult->id);
	}
}
