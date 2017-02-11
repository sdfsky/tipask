<?php

namespace App\Http\Controllers\Account;

use App\Models\UserData;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class TopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function coins()
    {
        $users = Cache::remember('top_coin_users',60,function() {
            return  UserData::top('coins',50);
        });
        return view('theme::top.coins')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function answers()
    {
        $users = Cache::remember('top_answer_users',60,function() {
            return  UserData::top('answers',50);
        });

        return view('theme::top.answers')->with('users',$users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function articles()
    {
        $users = Cache::remember('top_article_users',60,function() {
            return  UserData::top('articles',50);
        });
        return view('theme::top.articles')->with('users',$users);
    }

}
