<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Practice extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Practice can have many vets.
     *
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
     * PRACTICE_ADMIN can add new vet to their practice.
     *
     */
    public function addVet($name, $email)
    {
        $this->vets()->create([
            'name'        => $name,
            'email'       => $email,
            'password'    => Hash::make(str_random(10)),
            'type'        => User::VET,
        ]);
    }

    /**
     * Returns the results for the practice of the authenticated user. 
     * Global scope from LabResult model is not applied.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results()
    {
        return $this->hasMany(LabResult::class, 'practice_id')->withoutGlobalScopes();
    }

    /**
     * Returns all vets for the practice of the authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allVets()
    {
        return $this->vets()->whereType(User::VET)->paginate(12);
    }

    /**
     * Query scope - returns all practices and eager loads vets, results, and admins.
     *
     */
    public function scopeFetchAll($query)
    {
        return $query->with('vets')
                     ->with('results')
                     ->with('admin')
                     ->oldest();
    }

    /**
     * Query scope - using this function for the LabResult@parseAndSave method.
     *
     * @param $query
     * @param $practice_id from CSV file column practice_id.
     *                returns the name of the practice.
     *
     * @return mixed
     */
    public function scopeName($query, $practice_id)
    {
        return $query->find($practice_id)->name;
    }

    /**
     * Returns the admins of practices.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function admin()
    {
        return $this->vets()->whereType(User::PRACTICE_ADMIN);
    }

    /**
     * Returns the percentage of processed results for the practice.
     *
     * @return integer
     */
    public function processedResultsPercentage()
    {
        return number_format(
            ($this->results()->processed()->count() / $this->results->count()) * 100
        );
    }

    /**
     * Returns the percentage of processed results for the practice, if there are any, else returns zero.
     *
     * @return integer
     */
    public function getProcessedResultsPercentageAttribute()
    {
        return $this->results->count() > 0 ? $this->processedResultsPercentage() : 0;
    }
    
    /**
     * Returns the name of the practice creator.
     *
     */
    public function getCreatorNameAttribute()
    {
        return ($this->creator !== null) ? $this->creator->name : 'Not Available';
    }

    /**
     * Returns the number of the practices created for the current month.
     *
     * @return Integer
     */
    public function getCreatedThisMonthAttribute()
    {
        return $this->where('created_at', '>=', now()->startOfMonth())->count();
    }    

    /**
     * Returns the total number of created practices.
     *
     * @return Integer
     */
    public function getCountAllAttribute()
    {
        return $this->count();
    }
}
