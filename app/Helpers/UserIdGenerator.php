<?php

namespace App\Helpers;

interface UserIdGenerator
{
	/**
     * Generate a hash for a given user.
     *
     * @param $user
     *
     * @return string
     */
    public function generateFor($user);
}
