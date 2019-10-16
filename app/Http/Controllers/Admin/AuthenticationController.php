<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\Authentication;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
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

        /*分类过滤*/
        if( $filter['category_id']> 0 ){
            $category = Category::findFromCache($filter['category_id']);
            if($category){
                $query->whereIn('category_id',$category->getSubIds());
            }
        }
        $authentications = $query->orderBy('updated_at','desc')->paginate(20);
        return view('admin.authentication.index')->with(compact('filter','authentications'));
    }

    public function create(){
        $provinces = Area::provinces();
        return view('admin.authentication.create')->with(compact('provinces'));
    }

    public function store(Request $request){
        $request->flash();
        $this->validateRules['user_id'] = 'required|integer|unique:authentications';
        $this->validate($request,$this->validateRules);
        $userId = $request->input('user_id');
        $authUser = User::find($userId);
        if(!$authUser){
            return $this->error(route('admin.authentication.create'),'申请认证的用户不存在，请核实user_id');
        }

        $data = $request->all();
        if(isset($data['is_recommend']) && $data['is_recommend'] ==1){
            $data['recommend_at'] = Carbon::now();
        }

        if($request->hasFile('id_card_image')){
            $savePath = storage_path('app/authentications');
            $file = $request->file('id_card_image');
            $fileName = uniqid(str_random(8)).'.'.$file->getClientOriginalExtension();
            $target = $file->move($savePath,$fileName);
            if($target){
                $data['id_card_image'] = 'authentications-'.$fileName;
            }
        }

        if($request->hasFile('skill_image')){
            $savePath = storage_path('app/authentications');
            $file = $request->file('skill_image');
            $fileName = uniqid(str_random(8)).'.'.$file->getClientOriginalExtension();
            $target = $file->move($savePath,$fileName);
            if($target){
                $data['skill_image'] = 'authentications-'.$fileName;
            }
        }

        $authentication = Authentication::create($data);
        if($authentication){
            Tag::multiSave($request->input('skill'),$request->user());
        }

        return $this->success(route('admin.authentication.index'),'行家认证信添加成功');

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
        $request->flash();
        $oldStatus = $authentication->status;
        $this->validateRules['id_card'] = 'required|max:64|unique:authentications,id_card,'.$authentication->user_id.',user_id';
        $this->validate($request,$this->validateRules);

        $data = $request->all();
        $data['recommend_at'] = null;
        if(isset($data['is_recommend']) && $data['is_recommend'] ==1){
            $data['recommend_at'] = Carbon::now();
        }
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

        $result = $authentication->update($data);

        if($result){
            Tag::multiSave($request->input('skill'),$request->user());
        }

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

    public function recommend(Request $request){
        $ids = $request->input('id');
        Authentication::whereIn('user_id', $ids)->where('status','>', 0)->update(['recommend_at'=>Carbon::now()]);
        return $this->success(route('admin.authentication.index'),'行家推荐显示成功！');
    }

}
