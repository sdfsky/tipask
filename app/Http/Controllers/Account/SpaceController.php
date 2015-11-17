<?php
/**
 * 用户空间
 */
namespace App\Http\Controllers\Account;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        return view('theme::space.index');
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





}
