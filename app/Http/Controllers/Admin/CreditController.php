<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 2017/3/4
 * Time: 上午12:01
 */

namespace App\Http\Controllers\Admin;


use App\Models\Credit;
use App\Models\User;
use Illuminate\Http\Request;

class CreditController extends AdminController
{

    public function index(){
        $query = Credit::query();
        $query->where(function($query){
            $query->where('credits','<>',0)
                  ->orWhere('coins','<>',0);
        });
        /*充值人过滤*/
        if( isset($filter['user_id']) &&  $filter['user_id'] > 0 ){
            $query->where('user_id','=',$filter['user_id']);
        }
        /*时间过滤*/
        if( isset($filter['date_range']) && $filter['date_range'] ){
            $query->whereBetween('created_at',explode(" - ",$filter['date_range']));
        }
        $credits = $query->orderBy('created_at','desc')->paginate(20);
        $credits->map(function($credit){
            $credit->actionText = config('tipask.user_actions.'.$credit->action);
        });
        return view('admin.credit.index')->with(compact('credits'));
    }

    public function create(){
        return view('admin.credit.create');
    }

    public function store(Request $request){
        $validateRule = [
            'user_id' => 'required|integer',
            'action' => 'required|in:reward_user,punish_user',
            'coins' => 'required|integer|min:0',
            'credits' => 'required|integer|min:0'
        ];
        $request->flash();
        $this->validate($request,$validateRule);

        $userId = $request->input('user_id',0);
        $user = User::find($userId);
        if(!$user){
            return $this->error(route('admin.credit.create'),'用户不存在，请核实');
        }
        $action = $request->input('action');
        $coins = $request->input('coins');
        $credits = $request->input('credits');
        if( $action == 'punish_user'){
            $credits = intval(-$credits);
            $coins   = intval(-$coins);
        }
        $this->credit($userId,$action,$coins,$credits);
        return $this->success(route('admin.credit.index'),'充值成功');
    }

}