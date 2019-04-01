<?php

namespace App\Models;

use App\Events\UserCreated;
use App\Facades\PracticeHashid;
use App\Facades\UserHashid;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
   
    /**
     * User types.
     *
     * @var string
     */ 
    const ADMIN             = 'ADMIN';
    const FARM_LAB_MEMBER   = 'FARM_LAB_TEAM_MEMBER';
    const PRACTICE_ADMIN    = 'PRACTICE_ADMIN';
    const VET               = 'PRACTICE_VET';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that fire off the events.
     * 
     */
    protected $dispatchesEvents = [
        'created' => UserCreated::class
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Vet has many lab results.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results()
    {
        return $this->hasMany(LabResult::class, 'vet_id');
    }

    /**
     * User belongs to Practice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function practice()
    {
        return $this->belongsTo(Practice::class, 'practice_id');
    }

    /**
     * Lab team member can create many practices.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function practices()
    {
        return $this->hasMany(Practice::class, 'created_by');
    }    

    /**
     * User can upload many files.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(File::class, 'uploaded_by');
    }

    /**
     * Finds the user by its hashid.
     *
     * @return void
     * @author 
     */
    public static function findByHashid($hashid)
    {
        return self::where('hash_id', $hashid)->firstOrFail();
    }

    /**
     * User FARM_LAB_ADMIN can add a FARM_LAB_MEMBER
     */
    public function addFarmLabMember()
    {
        $labMember = $this->create([
            'name'     => request('name'),
            'email'    => request('email'),
            'password' => Hash::make(str_random(10)),
            'type'     => self::FARM_LAB_MEMBER,
        ]);

        $labMember->update(['hash_id' => UserHashid::generateFor($labMember)]);
    }

    /**
     * Farm lab team member can add a new practice, and practice admin is created in that process. One can't be created
     * without the other.
     */
    public function addPractice()
    {
        $practice = $this->practices()->create([
            'name' => request('name'),
        ]);

        $practice->update(['hash_id' => PracticeHashid::generateFor($practice)]);

        $practice->addAdmin();
    }

    /**
     * Return users with type FARM_LAB_TEAM_MEMBER
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function scopeLabMembers($query)
    {
        return $query->whereType(self::FARM_LAB_MEMBER);
    }

    /**
     * If the authenticated user is of provided type return true.
     * 
     * Using this helper function for middleware MustBeFarmlabMember, 
     * MustBePracticeMember, MustBePracticeAdmin classes.
     *
     * @param      $typeA (Constant - User type)
     * @param null $typeB (Constant - User type)
     *
     * @return bool
     */
    public function isOfType($typeA, $typeB = null)
    {
        return collect([$typeA, $typeB])->contains(auth()->user()->type);
    }

    /**
     * Returns the practices created this month by the authenticated user.
     *
     * @return integer
     */
    public function getCreatedPracticesThisMonthAttribute()
    {
        return $this->practices()
            ->where('created_at', '>=', now()->startOfMonth())
            ->count();
    }

    /**
     * Counts all created practices by the authenticated user.
     *
     * @return integer
     */
    public function getCountCreatedPracticesAttribute()
    {
        return $this->practices->count();
    }

    /**
     * Returns the number of created team members for the current month.
     *
     * @return Integer
     */
    public function getTeamMembersAddedThisMonthAttribute()
    {
        return $this->labMembers()
                    ->where('created_at', '>=', now()->startOfMonth())
                    ->count();
    }    

    /**
     * Returns the total number of farm lab team members.
     *
     * @return integer
     */
    public function getCountAllTeamMembersAttribute()
    {
        return $this->labMembers()->count();
    }

    /**
     * Returns true if the user has verified email.
     *
     * @return boolean
     */
    public function getIsVerifiedAttribute()
    {
        return $this->email_verified_at !== null;
    }

    /**
     * Returns the number of the uploaded files by the user.
     *
     * @return Integer
     */
    public function getUploadedFilesAttribute()
    {
        return $this->files->count();
    }

    /**
     * Returns the percentage of processed results for the vet.
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
     * Returns the percentage of processed results for the vet, if there are any, otherwise returns 0.
     *
     * @return integer
     */
    public function getProcessedResultsPercentageAttribute()
    {   
        return $this->results->count() > 0 ? $this->processedResultsPercentage() : 0;
    }

    /**
     * Returns the formatted type, for the auth user.
     *
     * @return string
     */
    public function getFormattedTypeAttribute()
    {
        return ucwords(strtolower(str_replace('_', ' ', auth()->user()->type)));
    }
}
