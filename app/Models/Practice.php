<?php

namespace App\Models;

use App\Facades\UserHashid;
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
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'hash_id';
    }

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
     * Practice admin is created as part of the practice creation process. When Practice is created,
     * addAdmin method is triggered.
     *
     * @return void
     */
    public function addAdmin()
    {
        $admin = $this->vets()->create([
            'name'        => request('admin_name'),
            'email'       => request('email'),
            'password'    => Hash::make(str_random(10)),
            'type'        => User::PRACTICE_ADMIN,
        ]);

        $admin->update([
            'hash_id' => UserHashid::generateFor($admin)
        ]);
    }


    /**
     * PRACTICE_ADMIN can add new vet to their practice.
     *
     */
    public function addVet($name, $email)
    {
        $vet = $this->vets()->create([
            'name'        => $name,
            'email'       => $email,
            'password'    => Hash::make(str_random(10)),
            'type'        => User::VET,
        ]);

        $vet->update(['hash_id' => UserHashId::generateFor($vet)]);
    }

    /**
     * Returns the results for the practice of the authenticated user. 
     * Global scope from LabResult model is not applied.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results()
    {
        return $this->hasMany(LabResult::class)->with('vet');
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
     * Returns the name of the practice. Using this function for the LabResult@parseAndSave method.
     *
     * @param $id from CSV file column practice_id.
     *
     * @return mixed
     */
    public static function name($id)
    {
        return self::find($id)->name;
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
            ($this->results->filter->isProcessed()->count() / $this->results->count()) * 100
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
        return $this->creator !== null ? $this->creator->name : 'Not Available';
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
