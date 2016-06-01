<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;

class Doing extends Model
{
    use BelongsToUserTrait;
    protected $table = 'doings';
    protected $fillable = ['user_id', 'action','source_type','source_id','subject','content','refer_id','refer_user_id','refer_content','created_at'];
    public $timestamps = false;

    static function correlation(User $user)
    {
      return self::join('attentions', function ($join) use($user) {
               $join->on('attentions.source_id', '=', 'doings.source_id')
                    ->on('attentions.source_type', '=', 'doings.source_type')
                    ->where('attentions.user_id','=',$user->id);
           })->where('doings.user_id','<>',$user->id)
             //->where('attentions.created_at','<','doings.created_at')
             ->select('doings.*')
             ->orderBy('doings.created_at','DESC');
    }


}
