<?php

namespace App\Models;

use App\Mail\Welcome;
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
    const VERIFIED          = 'VERIFIED'; // tmp user status
    const NOT_VERIFIED      = 'NOT_VERIFIED';  // tmp user status

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
     *
     * If the authenticated user is of type1 or type2 return true.
     * Using this for middleware MustBeFarmlabMember, MustBePracticeMember, MustBePracticeAdmin class.
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
      * Returns all practice members for the practice of the authenticated user.
      * 
     * @return \Illuminate\Database\Eloquent\Collection
     */   
    public function allVets()
    {
        return $this->where('practice_id', auth()->user()->practice_id)
                    ->whereType(User::VET)
                    ->oldest()
                    ->paginate(10);
    }

    /**
     * Send a welcome email to newly created user.
     *
     * @param $newUser
     *
     * @return App\Mail\Welcome
     */
    protected function sendWelcomeEmail($newUser)
    {
        return \Mail::to(request('email'))->queue(new Welcome($newUser));
    }

    /**
     * User FARM_LAB_ADMIN can add a FARM_LAB_MEMBER
     */
    public function addFarmLabMember()
    {
        $newUser = $this->create([
            'name'     => request('name'),
            'email'    => request('email'),
            'password' => Hash::make(request('password')),
            'type'     => User::FARM_LAB_MEMBER,
            'status'   => User::NOT_VERIFIED
        ]);

        $this->sendWelcomeEmail($newUser);
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

        $newUser = $this->create([
            'name'        => request('admin_name'),
            'email'       => request('email'),
            'password'    => bcrypt(request('password')),
            'type'        => User::PRACTICE_ADMIN,
            'status'      => User::NOT_VERIFIED,
            'practice_id' => $practice->id
        ]);

        $this->sendWelcomeEmail($newUser);
    }

    /**
     * PRACTICE_ADMIN can add new vet to their practice.
     */
    public function addVet()
    {
        $newVet = $this->create([
            'name'        => request('name'),
            'email'       => request('email'),
            'password'    => Hash::make(request('password')),
            'type'        => User::VET,
            'status'      => User::NOT_VERIFIED,
            'practice_id' => auth()->user()->practice_id
        ]);

        $this->sendWelcomeEmail($newVet);
    }

    /**
     * Returns the practices created this month by the authenticated user.
     *
     * @return Integer
     */
    public function getCreatedPracticesThisMonthAttribute()
    {
        return count($this->createdPractices()
            ->where('created_at', '>=', now()->startOfMonth())
            ->get());
    }

    /**
     * Counts all created practices by the authenticated user.
     *
     * @return void
     */
    public function getCountCreatedPracticesAttribute()
    {
        return count($this->createdPractices()->get());
    }

    /**
     * Returns the number of created team members for the current month.
     *
     * @return Integer
     */
    public function getTeamMembersAddedThisMonthAttribute()
    {
        return count($this->whereType(User::FARM_LAB_MEMBER)
                          ->where('created_at', '>=', now()->startOfMonth())
                          ->get());
    }    

    /**
     * Returns the total number of farm lab team members.
     *
     * @return integer
     */
    public function getCountAllTeamMembersAttribute()
    {
        return count($this->whereType(User::FARM_LAB_MEMBER)->get());
    }

    /**
     * Returns true if the user is verified.
     *
     * @return boolean
     */
    public function getIsVerifiedAttribute()
    {
        return ($this->status === User::VERIFIED) ? true : false;
    }

    /**
     * Returns the number of the uploaded files by the user.
     *
     * @return Integer
     */
    public function getUploadedFilesAttribute()
    {
        return count($this->files);
    }

    /**
     * Returns the percentage of processed results for the vet.
     *
     * @return integer
     */
    public function getProcessedResultsPercentageAttribute()
    {   
        if (count($this->results) > 0) {
            return number_format(
                (count($this->results->where('status', 'PROCESSED')) / count($this->results)) * 100
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
