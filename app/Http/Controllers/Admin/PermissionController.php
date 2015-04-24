<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Bican\Roles\Models\Permission;
use Illuminate\Http\Request;
class PermissionController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        $permissions = Permission::paginate(15);
        return view('admin.permission.index')->with('permissions',$permissions);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        return view('admin.permission.create');
	}


    public function postCreate(Request $request){
        $request->flash();
        /*表单数据校验*/
        $this->validate($request, [
            'name' => 'required|max:200',
            'slug' => 'required|max:150|unique:permissions',
            'description' => 'sometimes|max:255',
        ]);

        Permission::create($request->all());
        success('权限创建成功');
        return redirect(url('admin/permission/index'));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function getEdit($id)
    {
        $permission = Permission::find($id);
        return view('admin.permission.edit')->with('permission',$permission);
    }


    public function postEdit($id,Request $request){
        $request->flash();
        $permission = Permission::find($id);
        /*表单数据校验*/
        $this->validate($request, [
            'name' => 'required|max:200',
            'slug' => 'required|max:150|unique:permissions,slug,'.$permission->id,
            'description' => 'sometimes|max:255',
        ]);

        $permission->name = $request->input('name');
        $permission->slug = $request->input('slug');
        $permission->description = $request->input('description');
        $permission->save();
        success('权限修改成功');
        return redirect(url('admin/permission/index'));

    }


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
