<?php

namespace App\Policies;

use App\Models\Answer;
use App\Models\User;
use App\Policies\Traits\AdminTrait;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization,AdminTrait;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user,Answer $answer){
        return $answer->user_id == $user->id;
    }

    public function updateInTime(User $user,Answer $answer){
        if( Setting()->get('edit_answer_timeout') && $answer->created_at->diffInMinutes() > Setting()->get('edit_answer_timeout') ){
            return false;
        }
        return true;
    }

    public function adopt(User $user,Answer $answer){
        return $answer->question->user_id == $user->id;
    }

}
