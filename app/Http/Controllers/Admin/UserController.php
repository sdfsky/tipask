<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\User;
use App\Services\Registrar;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends AdminController
{
    /*权限验证规则*/
    protected $validateRules = [
        'name' => 'required|max:100',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:6|max:20',
    ];
    /**
     * 用户管理首页
     */
    public function index(Request $request)
    {
        $filter =  $request->all();

        $query = User::query();

        if(isset($filter['user_id']) && $filter['user_id'] > 0){
            $query->where("id","=",$filter['user_id']);
        }

        /*关键词过滤*/
        if( isset($filter['word']) && $filter['word'] ){
            $query->where(function($subQuery) use ($filter) {
                return $subQuery->where('name','like',$filter['word'].'%')
                         ->orWhere('email','like',$filter['word'].'%')
                         ->orWhere('mobile','like',$filter['word'].'%');
            });
        }

        /*注册时间过滤*/
        if( isset($filter['date_range']) && $filter['date_range'] ){
            $query->whereBetween('created_at',explode(" - ",$filter['date_range']));
        }

        /*状态过滤*/
        if( isset($filter['status']) && $filter['status'] > -2 ){
            $query->where('status','=',$filter['status']);
        }

        $users = $query->orderBy('created_at','desc')->paginate(Config::get('tipask.admin.page_size'));
        return view('admin.user.index')->with('users',$users)->with('filter',$filter);
    }

    /**
     * 显示用户添加页面
     */
    public function create()
    {
        $roles = Role::orderby('name','asc')->get();

        return view('admin.user.create')->with(compact('roles'));
    }

    /**
     * 保存创建用户信息
     */
    public function store(Request $request,Registrar $registrar)
    {

        $request->flash();
        $this->validate($request,$this->validateRules);

        $formData = $request->all();
        $formData['status'] = 1;
        $formData['visit_ip'] = $request->getClientIp();

        $user = $registrar->create($formData);
        $user->attachRole($request->input('role_id'));
        return $this->success(route('admin.user.index'),'用户添加成功！');

    }


    /**
     * 显示用户编辑页面
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::orderby('name','asc')->get();
        $provinces = Area::provinces();
        $cities = Area::cities($user->province);
        $data = [
            'provinces' => $provinces,
            'cities' => $cities,
        ];
        return view('admin.user.edit')->with(compact('user','roles','data'));
    }

    /**
     * 保存用户修改
     */
    public function update(Request $request, $id)
    {
        $request->flash();
        $user = User::find($id);
        if(!$user){
            abort(404);
        }
        $this->validateRules['name'] = 'required|email|max:255|unique:users,name,'.$user->id;
        $this->validateRules['email'] = 'required|email|max:255|unique:users,email,'.$user->id;
        $this->validateRules['password'] = 'sometimes|min:6';
        $password = $request->input('password');
        if($password)
        {
            $user->password = bcrypt($password);
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->title = $request->input('title','');
        $user->gender = $request->input('gender',0);
        $user->province = $request->input('province',0);
        $user->city = $request->input('city',0);
        $user->description = $request->input('description');
        $user->status = $request->input('status',0);

        if($request->hasFile('avatar')){
            $user_id = $user->id;
            $file = $request->file('avatar');
            $avatarDir = User::getAvatarDir($user_id);
            $extension = $file->getClientOriginalExtension();

            File::delete(storage_path('app/'.User::getAvatarPath($user_id,'big')));
            File::delete(storage_path('app/'.User::getAvatarPath($user_id,'middle')));
            File::delete(storage_path('app/'.User::getAvatarPath($user_id,'small')));

            Storage::disk('local')->put($avatarDir.'/'.User::getAvatarFileName($user_id,'origin').'.'.$extension,File::get($file));
            Image::make(storage_path('app/'.User::getAvatarPath($user_id,'origin',$extension)))->resize(128,128)->save(storage_path('app/'.User::getAvatarPath($user_id,'big')));
            Image::make(storage_path('app/'.User::getAvatarPath($user_id,'origin',$extension)))->resize(64,64)->save(storage_path('app/'.User::getAvatarPath($user_id,'middle')));
            Image::make(storage_path('app/'.User::getAvatarPath($user_id,'origin',$extension)))->resize(24,24)->save(storage_path('app/'.User::getAvatarPath($user_id,'small')));
        }

        $user->save();
        $user->detachAllRoles();
        $user->attachRole($request->input('role_id'));
        return $this->success(route('admin.user.index'),'用户修改成功');
    }

    /*用户审核*/
    public function verify(Request $request)
    {
        $userIds = $request->input('id');
        User::whereIn('id',$userIds)->update(['status'=>1]);
        return $this->success(route('admin.user.index').'?status=0','用户审核成功');

    }

    /**
     * 删除用户
     */
    public function destroy(Request $request)
    {
        $userIds = $request->input('id');
        User::destroy($userIds);
        return $this->success(route('admin.user.index'),'用户删除成功');

    }
}
