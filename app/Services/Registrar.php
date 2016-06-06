<?php namespace App\Services;

use App\Models\User;
use App\Models\UserData;
use Carbon\Carbon;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:100',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'status' => $data['status'],
            'site_notifications' => 'follow_user,invite_answer,comment_question,comment_article,adopt_answer,comment_answer,reply_comment',
            'email_notifications' => 'adopt_answer,invite_answer'
        ]);

        if($user){
            UserData::create([
                'user_id' => $user->id,
                'coins' => 0,
                'credits' => 20,
                'registered_at' => Carbon::now(),
                'last_visit' => Carbon::now(),
                'last_login_ip' => $data['visit_ip'],
            ]);
        }

        return $user;
    }


}
