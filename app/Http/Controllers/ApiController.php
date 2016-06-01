<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 16/6/1
 * Time: 下午5:04
 */

namespace app\Http\Controllers;


use App\Models\Article;
use App\Models\Question;
use Illuminate\Support\Facades\Cache;

class ApiController extends Controller
{

    public function getList(){

        $hotQuestions = Cache::remember('hot_questions',10,function() {
            return  Question::hottest(6);
        });

        /*悬赏问题*/
        $rewardQuestions = Cache::remember('reward_questions',10,function() {
            return  Question::reward(8);
        });

        $hotArticles = Cache::remember('hot_articles',10,function() {
            return  Article::hottest(8);
        });

        return response()->json([
            'hotQuestions' => $hotQuestions->toArray(),
            'rewardQuestions' => $rewardQuestions->toArray(),
            'hotArticles' => $hotArticles->toArray(),
        ]);

    }

}