<?php

namespace App\Models;

use App\Mail\Welcome;
use App\Models\LabResult;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    
    const ADMIN             = 'ADMIN';
    const FARM_LAB_MEMBER   = 'FARM_LAB_TEAM_MEMBER';
    const PRACTICE_ADMIN    = 'PRACTICE_ADMIN';
    const VET               = 'PRACTICE_VET';
    const VERIFIED          = 'VERIFIED';
    const NOT_VERIFIED      = 'NOT_VERIFIED';

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
     * The "booting" method of the model.
     *
     * Sends welcome email to the new user.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $token = app('auth.password.broker')->createToken($user);
            \Mail::to(request('email'))->queue(new Welcome($user, $token));
        });
    }

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
            'password' => Hash::make(request('password')),
            'type'     => User::FARM_LAB_MEMBER,
            'status'   => User::NOT_VERIFIED
        ]);
    }

    /**
     * FARM_LAB_MEMBER can create new Practice, and practice admin is created in that process. You cant create one
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
            'password'    => bcrypt(request('password')),
            'type'        => User::PRACTICE_ADMIN,
            'status'      => User::NOT_VERIFIED,
            'practice_id' => $practice->id
        ]);
    }

    /**
     * PRACTICE_ADMIN can add new vet to their practice.
     */
    public function addVet()
    {
        $this->create([
            'name'        => request('name'),
            'email'       => request('email'),
            'password'    => Hash::make(request('password')),
            'type'        => User::VET,
            'status'      => User::NOT_VERIFIED,
            'practice_id' => auth()->user()->practice_id
        ]);
    }

    /**
     * Vets processes the result via form/modal.
     *
     */
    public function processResult($comment, $indicator)
    {
        $this->results()->update([
                'vet_comment'   => $comment,
                'vet_indicator' => $indicator,
                'status'        => LabResult::PROCESSED
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
     * @return Integer
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
     * @return void
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
    public function getProcessedResultsPercentageAttribute()
    {   
        if ($this->results()->withoutGlobalScopes()->count() > 0) {
            return number_format(
                ($this->results()->withoutGlobalScopes()->processed()->count() / 
                 $this->results()->withoutGlobalScopes()->count()) 
                 * 100
            );
        }
        return '0';
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
