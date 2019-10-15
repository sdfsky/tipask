<?php

namespace App\Models;

use App\Models\Relations\BelongsToUserTrait;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use BelongsToUserTrait;
    protected $table = 'exchanges';
    protected $fillable = ['user_id','coins', 'goods_id','real_name','phone','email','comment','status'];


    static function newest()
    {
        return self::orderBy('created_at','desc')->take(10)->get();
    }


    public function goods(){
        return $this->belongsTo('App\Models\Goods','goods_id');
    }


}
