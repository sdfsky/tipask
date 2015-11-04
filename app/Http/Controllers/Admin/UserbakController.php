<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;

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
        $users = User::paginate(15);
		return view('admin.user.index')->with('users',$users);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.user.create');
	}

    /**
     * 创建新用户
     */
    public function store(Request $request)
    {
        $request->flash();
        /*表单数据校验*/
        $this->validate($request, [
            'name' => 'required|max:100|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
        $password = $request->input('password');
        $data = $request->except(['password']);
        $data['password'] = bcrypt($password);
        User::create($data);
        success('用户创建成功');
        return redirect(url('admin/user/index'));
    }



	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
        return view('admin.user.edit')->with('user',$user);
	}



    public function update($id,Request $request){
        $user = User::find($id);

        $request->flash();
        /*表单数据校验*/
        $this->validate($request, [
            'name' => 'required|max:100|unique:users,name,'.$user->id,
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'password' => 'sometimes|min:6',
        ]);
        $password = $request->input('password');
        if($password)
        {
            $user->password = bcrypt($password);
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        success('用户修改成功');
        return redirect(url('admin/user/index'));

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
