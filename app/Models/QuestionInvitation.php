<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionInvitation extends Model
{
    protected $table = 'question_invitations';
    protected $fillable = ['question_id','user_id'];

    public function question(){
        return $this->belongsTo('App\Models\Question');
    }


}
