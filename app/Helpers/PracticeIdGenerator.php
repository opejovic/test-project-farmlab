<?php

namespace App\Helpers;

interface PracticeIdGenerator
{
	/**
     * Generate a hash for a given practice.
     *
     * @param $practice
     *
     * @return string
     */
    public function generateFor($practice);
}
