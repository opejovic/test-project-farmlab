<?php

namespace App\Helpers;

class HashidGenerator implements LabResultIdGenerator, UserIdGenerator
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
     * Encode model id to generate a hash.
     *
     * @param $model (User, Practice, LabResult)
     *
     * @return string
     */
	public function generateFor($model)
	{
		return $this->hashids->encode($model->id);
	}
}
