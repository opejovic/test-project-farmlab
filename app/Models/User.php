<?php

namespace App\Models;

use App\Mail\Welcome;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    const ADMIN = 'ADMIN';
    const FARM_LAB_MEMBER = 'FARM_LAB_TEAM_MEMBER';
    const PRACTICE_ADMIN = 'PRACTICE_ADMIN';
    const VET = 'PRACTICE_VET';
    const VERIFIED = 'VERIFIED'; // tmp user status
    const NOT_VERIFIED = 'NOT_VERIFIED';  // tmp user status

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
     * @param      $type1
     * @param null $type2
     *
     * @return bool
     */
    public function isOfType($type1, $type2 = null)
    {
        $user = auth()->user();
        return ($user->type === $type1 || $user->type === $type2) ? true : false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results()
    {
        return $this->hasMany(LabResult::class, 'vet_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function practice()
    {
        return $this->belongsTo(Practice::class);
    }

     /**
      * Returns all practice members for the practice of the authenticated user.
      * 
     * @return \Illuminate\Database\Eloquent\Collection
     */   
    public function allVets()
    {
        return $this->where('practice_id', auth()->user()->practice_id)->whereType(User::VET)
            ->latest()
            ->get();
    }

    /**
     * Send a welcome email to newly created user.
     *
     * @return new App\Mail\Welcome
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
            'password' => bcrypt(request('password')),
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

        $practice = $this->practice()
            ->create(['name' => request('name')]);

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
        $newUser = $this->create([
            'name'        => request('name'),
            'email'       => request('email'),
            'password'    => bcrypt(request('password')),
            'type'        => User::VET,
            'status'      => User::NOT_VERIFIED,
            'practice_id' => auth()->user()->practice_id
        ]);

        $this->sendWelcomeEmail($newUser);
    }
}
