<?php

namespace App\Http\Controllers\Blog;

use App\Models\Article;
use App\Models\Draft;
use App\Models\Question;
use App\Models\Tag;
use App\Models\UserData;
use App\Models\UserTag;
use App\Services\CaptchaService;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    /*问题创建校验*/
    protected $validateRules = [
        'title' => 'required|min:5|max:255',
        'content' => 'required|min:50|max:16777215',
        'summary' => 'sometimes|max:255',
        'tags' => 'sometimes|max:128',
        'category_id' => 'sometimes|numeric'
    ];

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $draftId = $request->query('draftId', '');
        $draft = Draft::find($draftId);
        if ($draftId && !$draft) {
            abort(404);
        }
        $formData = [];
        $formData['subject'] = '';
        $formData['content'] = '';
        $formData['category_id'] = 0;
        if($draft){
            $draft->form_data = json_decode($draft->form_data,true);
            $formData['subject'] = $draft->subject;
            $formData['content'] = $draft->editor_content;
            $formData['category_id'] = $draft->form_data['category_id'];
        }
        return view("theme::article.create")->with(compact('formData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CaptchaService $captchaService)
    {
        $loginUser = $request->user();
        if($request->user()->status === 0){
            return $this->error(route('website.index'),'操作失败！您的邮箱还未验证，验证后才能进行该操作！');
        }

        /*防灌水检查*/
        if( Setting()->get('article_limit_num') > 0 ){
            $questionCount = $this->counter('article_num_'. $loginUser->id);
            if( $questionCount > Setting()->get('article_limit_num')){
                return $this->showErrorMsg(route('website.index'),'你已超过每小时文章发表限制数'.Setting()->get('article_limit_num').'，请稍后再进行该操作，如有疑问请联系管理员!');
            }
        }

        $request->flash();

        /*如果开启验证码则需要输入验证码*/
        if( Setting()->get('code_create_article') ){
            $captchaService->setValidateRules('code_create_article',$this->validateRules);
        }

        $this->validate($request,$this->validateRules);

        $data = [
            'user_id'      => $loginUser->id,
            'category_id'      => intval($request->input('category_id',0)),
            'title'        => trim($request->input('title')),
            'content'  => clean($request->input('content')),
            'summary'  => $request->input('summary'),
            'status'       => 1,
        ];

        if($request->hasFile('logo')){
            $validateRules = [
                'logo' => 'required|image|max:'.config('tipask.upload.image_size'),
            ];
            $this->validate($request,$validateRules);
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filePath = 'articles/'.gmdate("Y")."/".gmdate("m")."/".uniqid(str_random(8)).'.'.$extension;
            Storage::disk('local')->put($filePath,File::get($file));
            $data['logo'] = str_replace("/","-",$filePath);
        }


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

            UserTag::multiIncrement($loginUser->id,$article->tags()->get(),'articles');

            if($article->status === 1 ){
                $this->credit($request->user()->id,'create_article',Setting()->get('coins_write_article'),Setting()->get('credits_write_article'),$article->id,$article->title);
                $message = '文章发布成功! '.get_credit_message(Setting()->get('credits_write_article'),Setting()->get('coins_write_article'));
            }else{
                $message = '文章发布成功！为了确保文章的质量，我们会对您发布的文章进行审核。请耐心等待......';
            }

            $this->counter( 'article_num_'. $article->user_id , 1 , 60 );


            return $this->success(route('blog.article.detail',['id'=>$article->id]),$message);


        }

        return  $this->error("文章发布失败，请稍后再试",route('website.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $article = Article::findOrFail($id);

        /*待审核文章游客不可见，管理员和内容作者可见*/
        if($article->status == 0){
            if(Auth()->guest()){
                abort(404);
            }
            $this->authorize('create',$article);
        }
        /*问题查看数+1*/
        $article->increment('views');

        $topUsers = Cache::remember('article_top_article_users',10,function() {
            return  UserData::top('articles',8);
        });

        /*相关问题*/
        $relatedQuestions = Question::correlations($article->tags()->pluck('tag_id'));

        /*相关文章*/
        $relatedArticles = Article::correlations($article->tags()->pluck('tag_id'));

        /*设置通知为已读*/
        if($request->user()){
            $this->readNotifications($article->id,'article');
        }

        return view("theme::article.show")->with('article',$article)
                                          ->with('topUsers',$topUsers)
                                          ->with('relatedQuestions',$relatedQuestions)
                                          ->with('relatedArticles',$relatedArticles);
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

        /*编辑权限控制*/
        $this->authorize('update', $article);

        /*编辑问题时效控制*/
        if(!Gate::allows('updateInTime',$article)){
            return $this->showErrorMsg(route('website.index'),'你已超过文章可编辑的最大时长，不能进行编辑了。如有疑问请联系管理员!');
        }
        return view("theme::article.edit")->with(compact('article'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,CaptchaService $captchaService)
    {
        $article_id = $request->input('id');
        $article = Article::find($article_id);
        if(!$article){
            abort(404);
        }

        $this->authorize('update', $article);

        $request->flash();

        /*如果开启验证码则需要输入验证码*/
        if( Setting()->get('code_create_article') ){
            $captchaService->setValidateRules('code_create_article', $this->validateRules);
        }


        $this->validate($request,$this->validateRules);

        $article->title = trim($request->input('title'));
        $article->content = clean($request->input('content'));
        $article->summary = $request->input('summary');
        $article->category_id = $request->input('category_id',0);

        if($request->hasFile('logo')){
            $validateRules = [
                'logo' => 'required|image|max:'.config('tipask.upload.image_size'),
            ];
            $this->validate($request,$validateRules);
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filePath = 'articles/'.gmdate("Y")."/".gmdate("m")."/".uniqid(str_random(8)).'.'.$extension;
            Storage::disk('local')->put($filePath,File::get($file));
            $article->logo = str_replace("/","-",$filePath);
        }


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
