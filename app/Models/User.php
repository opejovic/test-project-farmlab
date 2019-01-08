<?php

namespace App\Models;

use App\Events\UserCreated;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    
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
     * Vet has many lab results.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results()
    {
        return $this->hasMany(LabResult::class, 'vet_id')->withoutGlobalScopes();
    }

    /**
     * A Vet belongs to a Practice.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function practice()
    {
        return $this->belongsTo(Practice::class);
    }

    /**
     * Lab team member can create many practices.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function createdPractices()
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
     * User FARM_LAB_ADMIN can add a FARM_LAB_MEMBER
     */
    public function addFarmLabMember()
    {
        $this->create([
            'name'     => request('name'),
            'email'    => request('email'),
            'password' => Hash::make(str_random(10)),
            'type'     => User::FARM_LAB_MEMBER,
        ]);
    }

    /**
     * FARM_LAB_MEMBER can create a new Practice, and practice admin is created in that process. You cant create one
     * without the other.
     */
    public function addPractice()
    {
        $practice = $this->practice()->create([
            'name'        => request('name'),
            'created_by'  => auth()->id()
        ]);

        $this->create([
            'name'        => request('admin_name'),
            'email'       => request('email'),
            'password'    => Hash::make(str_random(10)),
            'type'        => User::PRACTICE_ADMIN,
            'practice_id' => $practice->id
        ]);
    }

    /**
     * Vets processes the result via form/modal.
     *
     */
    public function processResult($labresultId, $comment, $indicator)
    {
        $this->results()->find($labresultId)->update([
                'vet_comment'   => $comment,
                'vet_indicator' => $indicator,
                'processed_at'  => $this->freshTimestamp(),
            ]);
    }

    /**
     * Return users with type FARM_LAB_TEAM_MEMBER
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function scopeLabMembers($query)
    {
        return $query->whereType(User::FARM_LAB_MEMBER);
    }

    /**
     *
     * If the authenticated user is of type1 or type2 return true.
     * Using this helper function for middleware MustBeFarmlabMember, MustBePracticeMember, MustBePracticeAdmin classes.
     *
     * @param      $type1 (Constant - User type)
     * @param null $type2 (Constant - User type)
     *
     * @return bool
     */
    public function isOfType($type1, $type2 = null)
    {
        $user = auth()->user();
        return ($user->type === $type1 || $user->type === $type2) ? true : false;
    }

    /**
     * Returns the practices created this month by the authenticated user.
     *
     * @return integer
     */
    public function getCreatedPracticesThisMonthAttribute()
    {
        return $this->createdPractices()
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
        return $this->createdPractices()->count();
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
        return $this->email_verified_at !== null ? true : false;
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
            ($this->results()->processed()->count() / $this->results()->count()) * 100
        );        
    }

    /**
     * Returns the percentage of processed results for the vet, if there are any, otherwise returns 0.
     *
     * @return integer
     */
    public function getProcessedResultsPercentageAttribute()
    {   
        return $this->results()->count() > 0 ? $this->processedResultsPercentage() : 0;
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
