<?php

namespace App\Http\Controllers\Shop;

use App\Models\Exchange;
use App\Models\Goods;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GoodsController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $goods = Goods::find($id);
        return view('theme::goods.show')->with('goods',$goods);
    }


    /*兑换礼品*/
    public function exchange(Request $request)
    {
        //$goods = Goods::find($goods_id);


        $validator = Validator::make($request->all(), [
            'goods_id' => 'required|integer',
            'real_name' => 'required|max:32',
            'phone' => 'required|regex:/^1[34578]{1}\d{9}$/',
            'email' => 'required|email|max:64',
            'comment' => 'max:512'
        ]);

        $goods = Goods::find($request->input('goods_id'));

        if(!$goods){
            return response()->json(['result'=>['common'=>['商品不存在，请核实！']]], 200);
        }

        if($goods->remnants <= 0){
            return response()->json(['result'=>['common'=>['商品库存不足，请选择其他商品进行兑换！']]], 200);
        }

        if($request->user()->userData->coins < $goods->coins ){
            return response()->json(['result'=>['common'=>['抱歉！您的金币不足！']]], 200);
        }

        if ($validator->fails()) {
            return response()->json(['result'=>$validator->messages()], 200);
        }

        $this->credit($request->user()->id,'exchange',-$goods->coins,0,$goods->id,$goods->name);

        try{
            $goods->decrement('remnants');
            $goods->save();
            $data = $request->all();
            $data['user_id'] = $request->user()->id;
            $data['coins'] = $goods->coins;
            $data['status'] = 0;
            Exchange::create($data);
        }catch(\Exception $e){
            return response()->json(['result'=>['common'=>['数据库操作失败，请稍后再试！']]], 200);
        }

        return response()->json(['result'=>'ok','data'=>$data],200);



    }

}
