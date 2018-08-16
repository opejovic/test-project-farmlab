<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    const ADMIN = 'ADMIN';  
    const FARMLABMEMBER = 'FARM_LAB_TEAM_MEMBER';  
    const PRACTICEADMIN = 'PRACTICE_ADMIN';  
    const VET = 'PRACTICE_VET';  
    const PROCESSED = 'PROCESSED';  // user status
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password', 'status', 'type', 'practice_id',
    // ];

    protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function results()
    {
        return $this->hasMany(LabResult::class);
    }

    public function practice()
    {
        return $this->belongsTo(Practice::class);
    }

    public static function addFarmLabMember()
    {
        static::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'type' => User::FARMLABMEMBER,
            'status' => User::PROCESSED
        ]);
    }

    public function addPracticeAdmin(Practice $practice)
    {
        $this->create([            
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'type' => User::PRACTICEADMIN,
            'status' => User::PROCESSED,
            'practice_id' => $practice->id
        ]);
    }

    public static function addVet()
    {
        static::create([            
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'type' => User::VET,
            'status' => User::PROCESSED,
            'practice_id' => auth()->user()->practice_id
        ]);
    }
}
