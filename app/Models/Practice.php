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
    public function addVet()
    {
        $this->vets()->create([
            'name'        => request('name'),
            'email'       => request('email'),
            'password'    => Hash::make(request('password')),
            'type'        => User::VET,
            'status'      => User::NOT_VERIFIED,
        ]);
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
     * Returns all vets of the practice of the authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allVets()
    {
        return $this->whereId(auth()->user()->practice_id)
                    ->firstOrFail()
                    ->vets()
                    ->whereType(User::VET)
                    ->paginate(12);
    }


    /**
     * Query scope - returns all practices and eager loads vets, results, and admins.
     *
     */
    public function scopeFetchAll($query)
    {
        return $query->oldest()
                     ->with('vets')
                     ->with('noScopeResults')
                     ->with('admin');
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
        return $query->whereId($practice_id)->first()->name;
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
            ($this->noScopeResults()->processed()->count() / $this->noScopeResults()->count()) * 100
        );
    }

    /**
     * Returns the percentage of processed results for the practice, if there are any, else returns zero.
     *
     * @return integer
     */
    public function getProcessedResultsPercentageAttribute()
    {
        return $this->noScopeResults()->count() > 0 ? $this->processedResultsPercentage() : 0;
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
