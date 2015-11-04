<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class UserController extends AdminController
{
    /*权限验证规则*/
    protected $validateRules = [
        'name' => 'required|max:100|unique:users',
        'password' => 'required|min:6|max:20',
    ];

    /**
     * 用户管理首页
     */
    public function index(Request $request)
    {
        $word = $request->input("word",'');
        $users = User::where('name','like',"%$word%")->paginate(Config::get('tipask.admin.page_size'));
        return view('admin.user.index')->with('users',$users)->with('word',$word);
    }

    /**
     * 显示用户添加页面
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * 保存创建用户信息
     */
    public function store(Request $request)
    {

    }


    /**
     * 显示用户编辑页面
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::orderby('name','asc')->get();
        return view('admin.user.edit')->with('user',$user)->with('roles',$roles);
    }

    /**
     * 保存用户修改
     */
    public function update(Request $request, $id)
    {
        $request->flash();
        $user = User::find($id);
        if(!$user){
            return $this->error(route('admin.user.index'),'权限不存在，请核实');
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
        $user->save();
        $user->detachAllRoles();
        $user->attachRole($request->input('role_id'));
        return $this->success(route('admin.user.index'),'用户修改成功');
    }

    /**
     * 删除用户
     */
    public function destroy($id)
    {

    }
}
