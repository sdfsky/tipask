<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 2017/3/8
 * Time: 下午1:23
 */

namespace App\Http\Controllers;


use App\Models\Article;
use App\Models\Question;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class SiteMapController extends Controller
{

    public function index(){
        $sitemap = App::make('sitemap');
        $sitemap->setCache('tipask.sitemap', 30);
        if (!$sitemap->isCached()) {
            /*静态链接*/
            $sitemap->add(URL::to(route('website.index')), null, '1.0', 'daily');
            $sitemap->add(URL::to(route('website.ask')), null, '1.0', 'daily');
            $sitemap->add(URL::to(route('website.topic')), null, '1.0', 'daily');
            $sitemap->add(URL::to(route('website.blog')), null, '1.0', 'daily');
            $sitemap->add(URL::to(route('website.user')), null, '0.9', 'daily');
            $sitemap->add(URL::to(route('website.shop')), null, '0.7', 'weekly');
            $sitemap->add(URL::to(route('website.experts')), null, '0.8', 'weekly');
            $sitemap->add(URL::to(route('auth.top.coins')), null, '0.7', 'weekly');
            $sitemap->add(URL::to(route('auth.top.answers')), null, '0.7', 'weekly');
            $sitemap->add(URL::to(route('auth.top.articles')), null, '0.7', 'weekly');

            $startTime = Carbon::now()->subMonth(12);
            /*问题*/
            $questions = Question::where("status", ">", 0)->where('created_at', '>', $startTime)->orderBy('created_at', 'desc')->take(2000)->get();
            foreach ($questions as $question) {
                $sitemap->add(URL::to(route('ask.question.detail', ['id' => $question->id])), $question->created_at, '0.9', 'daily');
            }

            /*文章*/
            $articles = Article::where("status", ">", 0)->where('created_at', '>', $startTime)->orderBy('created_at', 'desc')->take(1200)->get();
            foreach ($articles as $article) {
                $sitemap->add(URL::to(route('blog.article.detail', ['id' => $article->id])), $article->created_at, '0.9', 'daily');
            }

            /*话题*/
            $topics = Tag::where('created_at', '>', $startTime)->orderBy('created_at', 'desc')->take(500)->get();
            foreach ($topics as $topic) {
                $sitemap->add(URL::to(route('ask.tag.index', ['id' => $topic->id])), $topic->created_at, '0.8', 'daily');
            }

            /*用户*/
            $users = User::where("status", ">", 0)->where('created_at', '>', $startTime)->orderBy('created_at', 'desc')->take(500)->get();
            foreach ($users as $user) {
                $sitemap->add(URL::to(route('auth.space.index', ['id' => $user->id])), $user->created_at, '0.8', 'daily');
            }
        }

        return $sitemap->render('xml');
    }

}