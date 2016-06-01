<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;

class TagController extends AdminController
{
    /*权限验证规则*/
    protected $validateRules = [
        'name' => 'required|max:128',
        'url' => 'sometimes|max:128',
        'summary' => 'sometimes|max:255',
        'description' => 'sometimes|max:65535',
    ];


    /**
     *标签管理
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter =  $request->all();
        $query = Tag::query();

        /*问题标题过滤*/
        if( isset($filter['word']) && $filter['word'] ){
            $query->where('name','like', '%'.$filter['word'].'%');
        }

        /*时间过滤*/
        if( isset($filter['date_range']) && $filter['date_range'] ){
            $query->whereBetween('created_at',explode(" - ",$filter['date_range']));
        }


        $tags = $query->orderBy('updated_at','desc')->paginate(20);
        return view("admin.tag.index")->with('tags',$tags)->with('filter',$filter);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        if(!$tag){
           abort(404);
        }
        return view('admin.tag.edit')->with('tag',$tag);
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
        $tag = Tag::find($id);
        if(!$tag){
            return $this->error(route('admin.tag.index'),'话题不存在，请核实');
        }
        $this->validate($request,$this->validateRules);
        $tag->name = $request->input('name');
        $tag->summary = $request->input('summary');
        $tag->description = $request->input('description');
        if($request->hasFile('logo')){
            $savePath = storage_path('app/tags/'.gmdate('ym'));
            $file = $request->file('logo');
            $fileName = uniqid(str_random(8)).'.'.$file->getClientOriginalExtension();
            $target = $file->move($savePath,$fileName);
            if($target){
                $tag->logo = 'tags-'.gmdate('ym').'-'.$fileName;
            }
        }
        $tag->save();
        return $this->success(route('admin.tag.index'),'标签修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $tagIds = $request->input('id');
        Tag::destroy($tagIds);
        return $this->success(route('admin.tag.index'),'标签删除成功');
    }

}
