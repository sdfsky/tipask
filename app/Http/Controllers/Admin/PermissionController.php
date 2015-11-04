<?php

namespace App\Http\Controllers\Admin;

use Bican\Roles\Models\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class PermissionController extends AdminController
{

    /*权限验证规则*/
    protected $validateRules = [
        'name' => 'required|max:128',
        'model' => 'sometimes|max:128',
        'description' => 'sometimes|max:255',
    ];

    /**
     * 权限列表显示
     */
    public function index(Request $request)
    {
        $word = $request->input("word",'');
        $permissions = Permission::where('name','like',"%$word%")->paginate(Config::get('tipask.admin.page_size'));
        return view('admin.permission.index')->with('permissions',$permissions)->with('word',$word);
    }

    /**
     * 显示权限创建页面
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * 保存权限创建表单数据
     */
    public function store(Request $request)
    {
        $request->flash();
        $this->validateRules['slug'] = 'required|max:128|unique:permissions';
        $this->validate($request,$this->validateRules);
        Permission::create($request->all());
        return $this->success(route('admin.permission.index'),'权限添加成功');
    }


    /**
     * 显示权限编辑页面
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        if(!$permission){
            return $this->error(route('admin.permission.index'),'权限不存在，请核实');
        }
        return view('admin.permission.edit')->with('permission',$permission);
    }

    /**
     * 保存编辑表单数据
     */
    public function update(Request $request, $id)
    {
        $request->flash();
        $permission = Permission::find($id);
        if(!$permission){
           return $this->error(route('admin.permission.index'),'权限不存在，请核实');
        }
        $this->validateRules['slug'] = 'required|max:150|unique:permissions,slug,'.$permission->id;
        $this->validate($request,$this->validateRules);
        $permission->name = $request->input('name');
        $permission->slug = $request->input('slug');
        $permission->model = $request->input('model');
        $permission->description = $request->input('description');
        $permission->save();
        return $this->success(route('admin.permission.index'),'权限修改成功');
    }

    /**
     * 删除权限
     */
    public function destroy(Request $request)
    {
        Permission::destroy($request->input('id'));
        return $this->success(route('admin.permission.index'),'权限删除成功');
    }
}
