<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use App\Services\CreditService;
use App\Services\NotificationService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter =  $request->all();

        $query = Article::query();

        $filter['category_id'] = $request->input('category_id',-1);


        /*提问人过滤*/
        if( isset($filter['user_id']) &&  $filter['user_id'] > 0 ){
            $query->where('user_id','=',$filter['user_id']);
        }

        /*问题标题过滤*/
        if( isset($filter['word']) && $filter['word'] ){
            $query->where('title','like', '%'.$filter['word'].'%');
        }

        /*提问时间过滤*/
        if( isset($filter['date_range']) && $filter['date_range'] ){
            $query->whereBetween('created_at',explode(" - ",$filter['date_range']));
        }

        /*问题状态过滤*/
        if( isset($filter['status']) && $filter['status'] > -1 ){
            $query->where('status','=',$filter['status']);
        }

        /*分类过滤*/
        /*分类过滤*/
        if( $filter['category_id']> 0 ){
            $category = Category::findFromCache($filter['category_id']);
            if($category){
                $query->whereIn('category_id',$category->getSubIds());
            }
        }


        $articles = $query->orderBy('created_at','desc')->paginate(20);
        return view("admin.article.index")->with('articles',$articles)->with('filter',$filter);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    /*文章审核*/
    public function verify(Request $request)
    {
        $articleIds = $request->input('id');
        // 积分策略
        $articles = Article::whereIn('id',$articleIds)->where('status','<>',1)->select('id','user_id','title')->get();
        if (!empty($articles)){
            foreach ($articles as $article){
                CreditService::create($article->user_id,'create_article',Setting()->get('coins_write_article'),Setting()->get('credits_write_article'),$article->id,$article->title);
            }
        }
        Article::whereIn('id',$articleIds)->update(['status'=>1]);
        return $this->success(route('admin.article.index').'?status=0','文章审核成功');

    }

    /*修改分类*/
    public function changeCategories(Request $request){
        $ids = $request->input('ids','');
        $categoryId = $request->input('category_id',0);
        if($ids){
            Article::whereIn('id',explode(",",$ids))->update(['category_id'=>$categoryId]);
        }
        return $this->success(route('admin.article.index'),'分类修改成功');
    }



    /**
     * 删除文章
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $articleIds = $request->input('ids');
        // 给文章所有者发送站内通知
        $ids = explode(',',$articleIds);
        if ($request->input('report_type') == 99){
            $reason = $request->input('reason');
        }else{
            $reason = trans_report_type($request->input('report_type'));
        }
        foreach ($ids as $id){
            $article = Article::find($id);
            // 记录到通知
            NotificationService::notify(Auth()->user()->id, $article->user_id, 'remove_article', $article->title, $article->id, $reason);
            Article::destroy($id);
        }
//        Article::destroy($request->input('id'));
        return $this->success(route('admin.article.index'),'文章删除成功');
    }
}
