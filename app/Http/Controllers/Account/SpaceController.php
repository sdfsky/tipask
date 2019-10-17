<?php
/**
 * 用户空间
 */
namespace App\Http\Controllers\Account;

use App\Models\Credit;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class SpaceController extends Controller
{
    protected $user;

    public function __construct(Request $request){
        if($request->route()){
            $userId =  $request->route()->parameter('user_id',0);
            $user  = User::with('userData')->find($userId);

            if(!$user){
                abort(404);
            }
            $this->user = $user;
            View::share("userInfo",$user);
        }

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
        $this->user->userData->increment('views');
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

    public function articles()
    {
        $articles = $this->user->articles()->orderBy('created_at','DESC')->paginate(10);
        return view('theme::space.articles')->with('articles',$articles);
    }

    /*我的金币*/
    public function coins()
    {
        $coins = Credit::where('user_id','=',$this->user->id)->where('coins','<>',0)->orderBy('created_at','DESC')->paginate(10);
        $coins->map(function($coin){
            $coin->actionText = Config::get('tipask.user_actions.'.$coin->action);
        });
        return view('theme::space.coins')->with('coins',$coins);
    }


    /*我的经验*/
    public function credits()
    {
        $credits = Credit::where('user_id','=',$this->user->id)->where('credits','<>',0)->orderBy('created_at','DESC')->paginate(10);
        $credits->map(function($credit){
            $credit->actionText = Config::get('tipask.user_actions.'.$credit->action);
        });
        return view('theme::space.credits')->with('credits',$credits);
    }


    /*我的粉丝*/
    public function followers()
    {
        $followers = $this->user->followers()->orderBy('attentions.created_at','asc')->paginate(10);
        return view('theme::space.followers')->with('followers',$followers);
    }


    /*我的关注*/
    public function attentions(Request $request)
    {
        $source_type = $request->route()->parameter('source_type');
        $sourceClassMap = [
            'questions' => 'App\Models\Question',
            'users' => 'App\Models\User',
            'tags' => 'App\Models\Tag',
        ];

        if(!isset($sourceClassMap[$source_type])){
          abort(404);
        }

        $model = App::make($sourceClassMap[$source_type]);

        $attentions = $this->user->attentions()->where('source_type','=',$sourceClassMap[$source_type])->orderBy('attentions.created_at','desc')->paginate(10);
        $attentions->map(function($attention) use ($model) {
            $attention['info'] = $model::find($attention->source_id);
        });
        return view('theme::space.attentions')->with('attentions',$attentions)->with('source_type',$source_type);

    }

    public function collections(Request $request)
    {
        $source_type = $request->route()->parameter('source_type');

        $sourceClassMap = [
            'questions' => 'App\Models\Question',
            'articles' => 'App\Models\Article',
        ];

        if(!isset($sourceClassMap[$source_type])){
            abort(404);
        }

        $model = App::make($sourceClassMap[$source_type]);

        $collections = $this->user->collections()->where('source_type','=',$sourceClassMap[$source_type])->orderBy('collections.created_at','desc')->paginate(10);
        $collections->map(function($collection) use ($model) {
            $collection['info'] = $model::find($collection->source_id);
        });

        return view('theme::space.collections')->with('collections',$collections)->with('source_type',$source_type);


    }





}
