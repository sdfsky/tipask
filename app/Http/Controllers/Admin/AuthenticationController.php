<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\Authentication;
use Illuminate\Http\Request;

use App\Http\Requests;

class AuthenticationController extends AdminController
{


    protected  $validateRules = [
        'real_name' => 'required|max:64',
        'title' => 'required|max:128',
        'description' => 'sometimes|max:9999',
        'id_card' => 'required|max:64|unique:authentications',
        'id_card_image' => 'sometimes|image|max:2048',
        'skill' => 'required|max:128',
        'skill_image' => 'sometimes|image|max:2048',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Authentication::query();
        $filter =  $request->all();

        $filter['category_id'] = $request->input('category_id',-1);

        /*认证申请状态过滤*/
        if(isset($filter['status']) && $filter['status'] > -1){
            $query->where('status','=',$filter['status']);
        }

        if( isset($filter['id_card']) && $filter['id_card']){
            $query->where('id_card','=',$filter['id_card']);
        }

        if( $filter['category_id'] > 0 ){
            $query->where('category_id','=',$filter['category_id']);
        }

        $authentications = $query->orderBy('updated_at','desc')->paginate(20);
        return view('admin.authentication.index')->with(compact('filter','authentications'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $authentication = Authentication::find($id);
        $provinces = Area::provinces();
        $cities = Area::cities($authentication->province);
        $data = [
            'provinces' => $provinces,
            'cities' => $cities,
        ];
        return view('admin.authentication.edit')->with(compact('authentication','data'));

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
        $authentication = Authentication::find($id);
        if(!$authentication){
            return $this->error(route('admin.authentication.index'),'行家认证信息不存在，请核实');
        }
        $this->validate($request,$this->validateRules);

        $data = $request->all();
        if ($request->hasFile('id_card_image')) {
            $savePath = storage_path('app/authentications');
            $file = $request->file('id_card_image');
            $fileName = uniqid(str_random(8)) . '.' . $file->getClientOriginalExtension();
            $target = $file->move($savePath, $fileName);
            if ($target) {
                $data['id_card_image'] = 'authentications-' . $fileName;
            }
        }

        if ($request->hasFile('skill_image')) {
            $savePath = storage_path('app/authentications');
            $file = $request->file('skill_image');
            $fileName = uniqid(str_random(8)) . '.' . $file->getClientOriginalExtension();
            $target = $file->move($savePath, $fileName);
            if ($target) {
                $data['skill_image'] = 'authentications-' . $fileName;
            }
        }

        $authentication->update($data);
        return $this->success(route('admin.authentication.index'),'行家认证信息修改成功');


    }

    /*修改分类*/
    public function changeCategories(Request $request){
        $ids = $request->input('ids','');
        $categoryId = $request->input('category_id',0);
        if($ids){
            Authentication::whereIn('user_id',explode(",",$ids))->update(['category_id'=>$categoryId]);
        }
        return $this->success(route('admin.authentication.index'),'分类修改成功');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->input('id');
        Authentication::destroy($ids);
        return $this->success(route('admin.authentication.index'),'行家认证信息删除成功');
    }
}
