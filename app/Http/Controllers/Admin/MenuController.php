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
	public function getIndex(Request $request)
	{
        $query = Menu::query();
        $query->where('pid','=',$request->input('pid',0));
        $menus = $query->orderby('sort','asc')->orderby('updated_at','asc')->paginate(15);
        $request->flashOnly(['pid']);
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

        print_r($request->all());
        exit;
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
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postDestroy(Request $request)
	{
		$ids = $request->input('ids');
        Menu::where('pid','in',$ids)->delete();
        Menu::destroy($ids);
        success('菜单删除成功');
        return redirect(url('admin/menu/index'));
	}

}
