<?php

namespace App\Models;

use Carbon\Carbon;
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
     * Practice has a creator.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Returns the results for the practice of the authenticated user. 
     * Global scope from LabResult model is applied.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results()
    {
        return $this->hasMany(LabResult::class, 'practice_id');
    }    

    /**
     * Returns the results for the practice without the global scope from the LabResult model.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function noScopeResults()
    {
        return $this->results()->withoutGlobalScopes();
    }

    /**
     * Query scope
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

    /**
     * Returns the admins of practices.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function admin()
    {
        return $this->vets()->where('type', User::PRACTICE_ADMIN);
    }

    /**
     * Returns the percentage of processed results for the practice.
     *
     * @return integer
     */
    public function getProcessedResultsPercentageAttribute()
    {
        if (count($this->noScopeResults) > 0) {
            return number_format(
                (count($this->noScopeResults->where('status', LabResult::PROCESSED)) / 
                 count($this->noScopeResults)) * 100);
        }

        return '0';
    }
    
    /**
     * Returns the name of the practice creator.
     *
     */
    public function getCreatorNameAttribute()
    {
        return $this->creator->name;
    }

    /**
     * Returns the number of the practices created for the current month.
     *
     * @return Integer
     */
    public function getCreatedThisMonthAttribute()
    {
        return count($this->where('created_at', '>=', Carbon::now()->startOfMonth())->get());
    }    

    /**
     * Returns the total number of created practices.
     *
     * @return Integer
     */
    public function getCountAllAttribute()
    {
        return count($this->all());
    }
}
