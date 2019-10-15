<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use App\Policies\Traits\AdminTrait;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use AdminTrait;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show(User $user, Question $question){
        return $question->user_id == $user->id;
    }

    public function update(User $user,Question $question){
        return $question->user_id == $user->id;
    }

    public function updateInTime(User $user,Question $question){
        if( Setting()->get('edit_question_timeout') && $question->created_at->diffInMinutes() > Setting()->get('edit_question_timeout') ){
            return false;
        }
        return true;
    }


}
