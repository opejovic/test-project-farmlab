<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vets()
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results()
    {
        return $this->hasMany(LabResult::class);
    }

    /**
     * query scope
     *
     * @param $column from CSV file column practice_id.
     *              returns the name of the practice.
     *
     * @return mixed
     */
    public function scopeName($query, $column)
    {
        return $query->whereId($column)->first()->name;
    }
}
