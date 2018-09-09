<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    protected $guarded = [];

    public function vets()
    {
        return $this->hasMany(User::class);
    }

    public function results()
    {
        return $this->hasMany(LabResult::class);
    }

    /**
     * query scope
     *
     * @param $data from CSV file column practice_id.
     *              returns the name of the practice.
     *
     * @return mixed
     */
    public function scopeName($query, $data)
    {
        return $query->whereId($data)->first()->name;
    }
}
