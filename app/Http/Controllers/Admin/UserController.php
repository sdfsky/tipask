<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        $users = User::all();
		return view('admin.user.index')->with('users',$users);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return view('admin.user.create');
	}

    /**
     * 创建新用户
     */
    public function postCreate(Request $request)
    {
        $request->flash();
        /*表单数据校验*/
        $this->validate($request, [
            'name' => 'required|max:100|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
        User::create($request->all());
        return redirect(url('admin/user/index'));
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
		$user = User::find($id);
        return view('admin.user.edit')->with('user',$user);
	}



    public function postEdit($id,Request $request){
        $user = User::find($id);

        $request->flash();
        /*表单数据校验*/
        $this->validate($request, [
            'name' => 'required|max:100|unique:users,name,'.$user->id,
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'password' => 'required|min:6',
        ]);
        $user->save($request->all());
        return redirect(url('admin/user/index'));

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
