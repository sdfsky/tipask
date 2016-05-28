<?php

namespace App\Http\Controllers\Blog;

use App\Models\Article;
use App\Models\Question;
use App\Models\Tag;
use App\Models\UserData;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{

    /*问题创建校验*/
    protected $validateRules = [
        'title' => 'required|max:255',
        'content' => 'max:65535',
        'summary' => 'sometimes|max:255',
        'tags' => 'sometimes|max:128',
    ];





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("theme::article.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loginUser = $request->user();
        $request->flash();
        $this->validate($request,$this->validateRules);
        $data = [
            'user_id'      => $loginUser->id,
            'title'        => trim($request->input('title')),
            'content'  => clean($request->input('content')),
            'summary'  => $request->input('summary'),
            'status'       => 1,
        ];

        $article = Article::create($data);

        /*判断问题是否添加成功*/
        if($article){

            /*添加标签*/
            $tagString = trim($request->input('tags'));
            Tag::multiSave($tagString,$article);

            //记录动态
            $this->doing($article->user_id,'create_article',get_class($article),$article->id,$article->title,$article->summery);

            /*用户提问数+1*/
            $loginUser->userData()->increment('articles');

            return $this->success(route('blog.article.detail',['id'=>$article->id]),'文章发布成功');


        }

        return  $this->error("文章发布失败，请稍后再试",route('website.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $article = Article::find($id);

        /*问题查看数+1*/
        $article->increment('views');

        $topUsers = Cache::remember('top_article_users',10,function() {
            return  UserData::top('articles',8);
        });

        /*相关问题*/
        $relatedQuestions = Question::correlations($article->tags()->lists('tag_id'));

        /*相关文章*/
        $relatedArticles = Article::correlations($article->tags()->lists('tag_id'));

        return view("theme::article.show")->with('article',$article)
                                          ->with('topUsers',$topUsers)
                                          ->with('relatedQuestions',$relatedQuestions)
                                          ->with('relatedArticles',$relatedArticles);
        ;
    }

    /**
     * 显示文字编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $article = Article::find($id);

        if(!$article){
            abort(404);
        }

        if($article->user_id !== $request->user()->id){
            abort(401);
        }

        return view("theme::article.edit")->with('article',$article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $article_id = $request->input('id');
        $article = Article::find($article_id);
        if(!$article){
            abort(404);
        }

        if($article->user_id !== $request->user()->id){
            abort(401);
        }

        $request->flash();
        $this->validate($request,$this->validateRules);

        $article->title = trim($request->input('title'));
        $article->content = clean($request->input('content'));
        $article->summary = $request->input('summary');

        $article->save();
        $tagString = trim($request->input('tags'));

        /*更新标签*/
        Tag::multiSave($tagString,$article);

        return $this->success(route('blog.article.detail',['id'=>$article->id]),"文章编辑成功");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
