<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;

class QuestionInvitation extends Model
{
    use BelongsToUserTrait;
    protected $table = 'question_invitations';
    protected $fillable = ['question_id','user_id','from_user_id','send_to'];

    public function question(){
        return $this->belongsTo('App\Models\Question');
    }

}
