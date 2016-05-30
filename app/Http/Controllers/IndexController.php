<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Exchange;
use App\Models\FriendshipLink;
use App\Models\Goods;
use App\Models\Notice;
use App\Models\Question;
use App\Models\Recommendation;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\User;
use App\Models\UserData;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        /*热门话题*/
        $hotTags =  Taggable::globalHotTags();

        /*推荐内容*/
        $recommendItems= Cache::remember('recommend_items',10,function() {
            return Recommendation::where('status','>',0)->orderBy('sort','asc')->orderBy('updated_at','desc')->take(11)->get();
        });


        /*活跃用户*/
        $activeUsers = Cache::remember('active_users',10,function() {
               return  UserData::activities(8);
        });


        /*热门问题*/
        $hotQuestions = Cache::remember('hot_questions',10,function() {
            return  Question::hottest(8);
        });

        /*悬赏问题*/
        $rewardQuestions = Cache::remember('reward_questions',10,function() {
            return  Question::reward(8);
        });

        /*热门文章*/
        $hotArticles = Cache::remember('hot_articles',10,function() {
            return  Article::hottest(8);
        });

        /*最新文章*/
        $newestArticles = Cache::remember('newest_articles',10,function() {
            return  Article::newest(8);
        });


        /*最新公告*/
        $newestNotices = Cache::remember('newest_notices',10,function() {
            return  Notice::where('status','>','0')->orderBy('updated_at','DESC')->take(8)->get();
        });


        /*财富榜*/

        $topCoinUsers = Cache::remember('top_coin_users',10,function() {
            return  UserData::top('coins',8);
        });

        /*友情链接*/

        $friendshipLinks = Cache::remember('friendship_links',10,function() {
            return  FriendshipLink::where('status','=',1)->orderBy('sort','asc')->orderBy('created_at','asc')->take(50)->get();
        });

        return view('theme::home.index')->with(compact('recommendItems','activeUsers','hotQuestions','rewardQuestions','hotArticles','newestArticles','newestNotices','hotTags','topCoinUsers','friendshipLinks'));

    }


    /*问答模块*/
    public function ask($filter='newest')
    {

        $question = new Question();

        if(!method_exists($question,$filter)){
            abort(404);
        }

        $questions =  call_user_func([$question,$filter]);

        /*热门话题*/
        $hotTags =  Taggable::globalHotTags();



        $topAnswerUsers = UserData::top('answers',8);
        return view('theme::home.ask')->with('questions',$questions)
            ->with('topAnswerUsers',$topAnswerUsers)
            ->with('hotTags',$hotTags)
            ->with('filter',$filter);
    }


    public function blog($filter='recommended')
    {
        $article = new Article();
        if(!method_exists($article,$filter)){
            abort(404);
        }

        $articles = call_user_func([$article,$filter]);

        $hotUsers = UserData::activeInArticles();
        /*热门话题*/
        $hotTags =  Taggable::globalHotTags();



        return view('theme::home.blog')->with('articles',$articles)
                                       ->with('hotUsers',$hotUsers)
                                       ->with('hotTags',$hotTags)
                                       ->with('filter',$filter);
    }

    public function topic()
    {
        $topics = Tag::orderBy('followers','DESC')->paginate(20);
        return view('theme::home.topic')->with('topics',$topics);
    }


    public function user()
    {
        $users = UserData::orderBy('credits','desc')->orderBy('coins','desc')->orderBy('answers','desc')->paginate(20);
        return view('theme::home.user')->with('users',$users);

    }


    public function shop()
    {
        $goods = Goods::where('status','>',0)->where('remnants','>',0)->orderBy('coins','asc')->paginate(16);
        $exchanges = Exchange::newest();
        return view('theme::home.shop')->with(compact('goods','exchanges'));
    }

}
