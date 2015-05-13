<?php
/**
 * 用户角色管理
 * User: sdf_sky
 * Date: 15/5/13
 * Time: 下午10:11
 */

namespace App\Http\Controllers\Admin;


use Bican\Roles\Models\Role;
use Illuminate\Http\Request;

class RoleController extends AdminController{


    /**
     * 角色列表显示
     */
    public function getIndex()
    {
        $query = Role::query();
        $roles = $query->orderby('updated_at','asc')->paginate(15);
        return view("admin.role.index")->with("roles",$roles);

    }

    /**
     * 显示添加页面
     */
    public function getCreate()
    {
        return view("admin.role.create");
    }


    /**
     * 包括添加的角色数据
     */
    public function postCreate(Request $request)
    {
        $request->flash();
        /*表单数据校验*/
        $rules = array(
            'name' => 'required|max:200|unique:roles,name',
            'slug' => 'required|max:150|unique:roles,slug',
        );
        $this->validate($request,$rules);
        Role::create($request->all());
        success('角色创建成功');
        return redirect(url('admin/role/index'));

    }

    /**
     * 显示角色编辑页面
     */
    public function getEdit($id)
    {
        $role = Role::find($id);
        return view("admin.role.edit")->with("role",$role);

    }

    public function postEdit($id,Request $request)
    {
        $request->flash();
        /*表单数据校验*/
        $rules = array(
            'name' => 'required|max:200|unique:roles,name,'.$id,
            'slug' => 'required|max:150|unique:roles,slug,'.$id,
        );
        $this->validate($request, $rules);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->slug = $request->input('slug');
        $role->description = $request->input('description');
        $role->save();
        success('角色保存成功');
        return redirect(url('admin/role/index'));

    }

    /**
     * 删除角色
     */
    public function postDestroy(Request $request)
    {
        $ids = $request->input('ids');
        Role::destroy($ids);
        success('角色删除成功');
        return redirect(url('admin/role/index'));
    }

}