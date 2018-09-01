<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class AddMemberOrPracticeForm extends FormRequest
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (auth()->user()->type === User::ADMIN) {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed'
            ];
        } elseif (auth()->user()->type === User::FARMLABMEMBER) {
            return [
                'name' => 'required|unique:practices',
                'admin_name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed'
            ];
        }
    }
    public function persist()
    {
        if (auth()->user()->type === User::ADMIN) {

            $this->user->addFarmLabMember();
            session()->flash('message', 'New FarmLab team member added.');

        } elseif (auth()->user()->type === User::FARMLABMEMBER) {

            $this->user->addPractice();
            session()->flash('message', 'New practice created.');
        }
    }
}
