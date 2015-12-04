<?php
/**
 * 用户空间
 */
namespace App\Http\Controllers\Account;

use App\Models\Credit;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;

class SpaceController extends Controller
{
    protected $user;

    public function __construct(Request $request){
        $userId =  $request->route()->parameter('user_id');

        $user  = User::with('userData')->find($userId);

        if(!$user){
            abort(404);
        }
        $this->user = $user;
        View::share("userInfo",$user);
    }

    /**
     * 用户空间首页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doings = $this->user->doings()->orderBy('created_at','DESC')->paginate(10);
        $doings->map(function($doing){
            $doing->action_text = Config::get('tipask.user_actions.'.$doing->action);
        });
        return view('theme::space.index')->with('doings',$doings);
    }

    /**
     * 用户提问
     * @return View
     */
    public function questions()
    {
        $questions = $this->user->questions()->orderBy('created_at','DESC')->paginate(10);
        return view('theme::space.questions')->with('questions',$questions);
    }

    /**
     * 用户回答
     * @return mixed
     */
    public function answers()
    {
        $answers = $this->user->answers()->with('question')->orderBy('created_at','DESC')->paginate(10);
        return view('theme::space.answers')->with('answers',$answers);
    }


    public function coins()
    {
        $coins = Credit::where('user_id','=',$this->user->id)->where('coins','<>',0)->orderBy('created_at','DESC')->paginate(10);
        $coins->map(function($coin){
            $coin->action = Config::get('tipask.user_actions.'.$coin->action);
        });
        return view('theme::space.coins')->with('coins',$coins);
    }

    public function credits()
    {
        $credits = Credit::where('user_id','=',$this->user->id)->where('credits','<>',0)->orderBy('created_at','DESC')->paginate(10);
        $credits->map(function($credit){
            $credit->action = Config::get('tipask.user_actions.'.$credit->action);
        });
        return view('theme::space.credits')->with('credits',$credits);
    }





}
