<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Article;
use App\Models\Authentication;
use App\Models\Comment;
use App\Models\Exchange;
use App\Models\Question;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;

class AdminController extends Controller {

    public function __construct(Request $request){
        $startTime = Carbon::createFromTimestamp( Carbon::today()->timestamp - 7 * 24 * 3600 );
        /*未审核专家数*/
        $notVerifiedData['users'] = User::where('status','=',0)->where('created_at','>',$startTime)->count();
        /*未审核专家数*/
        $notVerifiedData['experts'] = Authentication::where('status','=',0)->count();
        /*未审核问题数*/
        $notVerifiedData['questions'] = Question::where('status','=',0)->count();
        /*未审核回答数*/
        $notVerifiedData['answers'] = Answer::where('status','=',0)->count();
        /*未审核文章数*/
        $notVerifiedData['articles'] = Article::where('status','=',0)->count();
        /*未审核评论数*/
        $notVerifiedData['comments'] = Comment::where('status','=',0)->count();
        /*未审兑换数*/
        $notVerifiedData['exchanges'] = Exchange::where('status','=',0)->count();

        //当前是否开启小菜单
        View::share('sidebar_collapse',Cookie::get('sidebar_collapse'));
        View::share('notVerifiedData',$notVerifiedData);
    }

}
