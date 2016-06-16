<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmailToken extends Model
{
    protected $table = 'email_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email','action','token'];


    public static function createAndSend($data)
    {

        $emailToken = self::create([
            'email' => $data['email'],
            'token' => $data['token'],
            'action'=>$data['action'],
            'created_at' => Carbon::now()
        ]);

        if($emailToken){

            Mail::queue('emails.findPassword', $data, function($message) use ($data)
            {
                $message->to($data['email'],$data['name'])->subject($data['subject']);
            });
        }

        return $emailToken;

    }


    /*清空toke信息*/
    public static function clear($email,$action)
    {
        self::where('email','=',$email)->where('action','=',$action)->delete();
    }



    public static function createToken()
    {
        return hash_hmac('sha256',Str::random(40),Config::get('key'));
    }


}
