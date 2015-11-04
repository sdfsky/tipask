<?php

namespace App\Http\Controllers\Admin;

use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class RoleController extends AdminController
{
    /*验证规则*/
    protected $validateRules = [
        'name' => 'required|max:128',
        'description' => 'sometimes|max:255',
    ];

    /**
     * 管理列表
     */
    public function index(Request $request)
    {
        $word = $request->input("word",'');
        $roles = Role::where('name','like',"%$word%")->paginate(Config::get('tipask.admin.page_size'));
        return view('admin.role.index')->with('roles',$roles)->with('word',$word);
    }

    /**
     * 显示添加页面
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * 添加表单处理
     */
    public function store(Request $request)
    {
        $request->flash();
        $this->validateRules['slug'] = 'required|max:128|unique:roles';
        $this->validate($request,$this->validateRules);
        Role::create($request->all());
        return $this->success(route('admin.role.index'),'角色添加成功');
    }


    /**
     * 显示编辑页面
     */
    public function edit($id)
    {
        $role = Role::find($id);
        if(!$role){
            return $this->error(route('admin.role.index'),'权限不存在，请核实');
        }
        /*获取角色已有权限*/
        $role_permission_ids = $role->permissions()->get()->map(function($role_permission){
            return $role_permission->id;
        });

        $permission['admin'] = Permission::where('slug','like','admin.%')->orderBy('name', 'asc')->get();
        return view('admin.role.edit')->with('role',$role)->with('permission',$permission)->with('role_permission_ids',$role_permission_ids);
    }

    /**
     * 修改角色信息
     */
    public function update(Request $request, $id)
    {
        $request->flash();
        $role = Role::find($id);
        if(!$role){
            return $this->error(route('admin.role.index'),'角色不存在，请核实');
        }
        $this->validateRules['slug'] = 'required|max:150|unique:roles,slug,'.$role->id;
        $this->validate($request,$this->validateRules);
        $role->name = $request->input('name');
        $role->slug = $request->input('slug');
        $role->description = $request->input('description');
        $role->save();
        return $this->success(route('admin.role.index'),'角色修改成功');
    }


    /**
     * 权限设置
     */
    public function permission(Request $request){
        $role = Role::find($request->input('id'));
        $role->detachAllPermissions();
        $permissions = $request->input('permissions',array());
        foreach($permissions as $permission){
            $role->attachPermission($permission);
        }
        return $this->success(route('admin.role.index'),'角色权限设置成功');

    }


    /**
     * 删除某个角色
     */
    public function destroy(Request $request)
    {

    }
}
