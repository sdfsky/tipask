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
        $data['password'] = bcrypt($data['password']);
        $data['site_notifications'] = 'follow_user,invite_answer,comment_question,comment_article,adopt_answer,comment_answer,reply_comment';
        $data['email_notifications'] = 'adopt_answer,invite_answer';
        $user =  User::create($data);
        if($user){
            $userData = [
                'user_id' => $user->id,
                'coins' => 0,
                'credits' => 20,
                'registered_at' => Carbon::now(),
                'last_visit' => Carbon::now(),
                'last_login_ip' => $data['visit_ip'],
            ];

            if( $user->mobile ){
                $userData['mobile_status'] = 1;
            }
            UserData::create($userData);
        }
        return $user;
    }

}
