<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends AdminController {

     protected $validateRules = [
         'name' => 'required|max:200',
         'url' => 'sometimes|max:150',
         'sort' => 'required|integer',
     ];

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{

        $menu = new Menu();
        $menuTrees = $menu->getAllTree();
        $menus = Menu::orderby('updated_at','desc')->paginate(15);
        return view('admin.menu.index')->with('menus',$menus);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        return view('admin.menu.create');
	}

    public function postCreate(Request $request)
    {
        $request->flash();
        /*表单数据校验*/
        $this->validate($request, $this->validateRules);

        Menu::create($request->all());
        success('菜单创建成功');
        return redirect(url('admin/menu/index'));
    }



	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$info = Menu::find($id);
        return view('admin.menu.edit')->with('info',$info);
	}


    public function postEdit($id,Request $request){
        $request->flash();
        /*表单数据校验*/
        $this->validate($request,$this->validateRules);
        $info = Menu::find($id);
        $info->name = $request->input('name');
        $info->pid = $request->input('pid');
        $info->url = $request->input('url');
        $info->icon = $request->input('icon');
        $info->sort = $request->input('sort');
        $info->save();
        success('菜单保存成功');
        return redirect(url('admin/menu/index'));
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
