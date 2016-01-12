<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table = 'user_data';

    public $timestamps = false;
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'coins','credits','last_login_ip','registered_at','last_visit'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];


    /*用户采纳率*/
    public function adoptPercent()
    {
        return round($this->adoptions / $this->answers, 2) * 100;
    }

}
