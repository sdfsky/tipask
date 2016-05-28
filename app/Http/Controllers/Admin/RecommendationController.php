<?php

namespace App\Http\Controllers\Admin;

use App\Models\Recommendation;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class RecommendationController extends AdminController
{
    /*权限验证规则*/
    protected $validateRules = [
        'subject' => 'required|max:255',
        'url' => 'required|max:255',
        'sort' => 'required|integer',
    ];



    /**
     * 显示推荐列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $word = $request->input("word",'');
        $recommendations = Recommendation::where('subject','like',"%$word%")->orderBy('sort','asc')->orderBy('updated_at','desc')->paginate(Config::get('tipask.admin.page_size'));
        return view('admin.recommendation.index')->with('recommendations',$recommendations)->with('word',$word);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.recommendation.create');
    }



    /**
     * 保存添加的推荐信息
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();
        $this->validate($request,$this->validateRules);
        $recommendation = Recommendation::create($request->all());
        if($request->hasFile('logo')){
            $savePath = storage_path('app/recommendations');
            $file = $request->file('logo');
            $fileName = uniqid(str_random(8)).'.'.$file->getClientOriginalExtension();
            $target = $file->move($savePath,$fileName);
            if($target){
                $recommendation->logo = 'recommendations-'.$fileName;
                $recommendation->save();
            }
        }

        return $this->success(route('admin.recommendation.index'),'推荐添加成功');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recommendation = Recommendation::find($id);
        if(!$recommendation){
            return $this->error(route('admin.recommendation.index'),'推荐不存在，请核实');
        }
        return view('admin.recommendation.edit')->with('recommendation',$recommendation);
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
        $request->flash();
        $recommendation = Recommendation::find($id);
        if(!$recommendation){
            return $this->error(route('admin.recommendation.index'),'推荐不存在，请核实');
        }
        $this->validate($request,$this->validateRules);
        $recommendation->subject = $request->input('subject');
        $recommendation->url = $request->input('url');
        $recommendation->sort = $request->input('sort');
        $recommendation->status = $request->input('status');
        if($request->hasFile('logo')){
            $savePath = storage_path('app/recommendations');
            $file = $request->file('logo');
            $fileName = uniqid(str_random(8)).'.'.$file->getClientOriginalExtension();
            $target = $file->move($savePath,$fileName);
            if($target){
                $recommendation->logo = 'recommendations-'.$fileName;
            }
        }
        $recommendation->save();
        return $this->success(route('admin.recommendation.index'),'推荐修改成功');
    }

    /**
     * 删除推荐
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Recommendation::destroy($request->input('ids'));
        return $this->success(route('admin.recommendation.index'),'推荐删除成功');
    }
}
