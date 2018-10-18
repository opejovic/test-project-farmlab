<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vets()
    {
        return $this->hasMany(User::class, 'practice_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results()
    {
        return $this->hasMany(LabResult::class, 'practice_id');
    }

    /**
     * query scope
     *
     * @param $query
     * @param $column from CSV file column practice_id.
     *                returns the name of the practice.
     *
     * @return mixed
     */
    public function scopeName($query, $column)
    {
        return $query->whereId($column)->first()->name;
    }


}
