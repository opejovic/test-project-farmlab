<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    const ADMIN = 'ADMIN';
    const FARM_LAB_MEMBER = 'FARM_LAB_TEAM_MEMBER';
    const PRACTICE_ADMIN = 'PRACTICE_ADMIN';
    const VET = 'PRACTICE_VET';
    const VERIFIED = 'VERIFIED';
    const NOT_VERIFIED = 'NOT_VERIFIED';  // tmp user status

    /**
     * The attributes that are mass assignable.
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
     * If the authenticated user is of type VET or PRACTICE_ADMIN, return true.
     * Using this for middleware CheckType class.
     *
     * @return bool
     */
    public function practiceType()
    {
        $user = auth()->user();
        if ($user->type === User::VET || $user->type === User::PRACTICE_ADMIN) {
            return true;
        }
        return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results()
    {
        return $this->hasMany(LabResult::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function practice()
    {
        return $this->belongsTo(Practice::class);
    }

    /**
     * User FARM_LAB_ADMIN can add a FARM_LAB_MEMBER
     */
    public function addFarmLabMember()
    {
        $this->create([
            'name'     => request('name'),
            'email'    => request('email'),
            'password' => bcrypt(request('password')),
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

        $practice = $this->practice()
            ->create(['name' => request('name')]);

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
            'password'    => bcrypt(request('password')),
            'type'        => User::VET,
            'status'      => User::NOT_VERIFIED,
            'practice_id' => auth()->user()->practice_id
        ]);
    }
}
