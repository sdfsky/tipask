<?php

namespace App\Http\Controllers\Admin;

use App\Models\Goods;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class GoodsController extends AdminController
{
    /*权限验证规则*/
    protected $validateRules = [
        'name' => 'required|max:128',
        'description' => 'sometimes|max:65535',
        'coins' => 'required|integer',
        'remnants' => 'required|integer',
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $word = $request->input("word",'');
        $goods = Goods::where('name','like',"%$word%")->orderBy('updated_at','DESC')->paginate(Config::get('tipask.admin.page_size'));
        return view('admin.goods.index')->with('goods',$goods)->with('word',$word);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.goods.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();
        $this->validate($request,$this->validateRules);
        $goods = Goods::create($request->all());
        if($request->hasFile('logo')){
            $savePath = storage_path('app/goods/'.gmdate('ym'));
            $file = $request->file('logo');
            $fileName = uniqid(str_random(8)).'.'.$file->getClientOriginalExtension();
            $target = $file->move($savePath,$fileName);
            if($target){
                $goods->logo = 'goods-'.gmdate('ym').'-'.$fileName;
                $goods->save();
            }
        }

        return $this->success(route('admin.goods.index'),'商品添加成功');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goods = Goods::find($id);
        if(!$goods){
            return $this->error(route('admin.goods.index'),'商品不存在，请核实');
        }
        return view('admin.goods.edit')->with('goods',$goods);
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
        $goods = Goods::find($id);
        if(!$goods){
            return $this->error(route('admin.goods.index'),'商品不存在，请核实');
        }

        $this->validate($request,$this->validateRules);
        $goods->name = $request->input('name');
        $goods->post_type = $request->input('post_type');
        $goods->remnants = $request->input('remnants');
        $goods->coins = $request->input('coins');
        $goods->description = $request->input('description');
        $goods->category_id = $request->input('category_id',0);
        $goods->status = $request->input('status');

        if($request->hasFile('logo')){
            $savePath = storage_path('app/goods/'.gmdate('ym'));
            $file = $request->file('logo');
            $fileName = uniqid(str_random(8)).'.'.$file->getClientOriginalExtension();
            $target = $file->move($savePath,$fileName);
            if($target){
                $goods->logo = 'goods-'.gmdate('ym').'-'.$fileName;
            }
        }
        $goods->save();
        return $this->success(route('admin.goods.index'),'商品修改成功');

    }

    /**
     * 删除商品
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Goods::destroy($request->input('ids'));
        return $this->success(route('admin.goods.index'),'商品删除成功');
    }
}
