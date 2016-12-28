<?php

namespace App\Http\Controllers\Account;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{

    /*问题创建校验*/
    protected $validateRules = [
        'content' => 'required|max:65535',
        'to_user_id' => 'required|integer',
    ];


    /**
     * 我的私信首页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loginUser = Auth()->user();

        /*子查询进行分组*/
        $subQuery = Message::where("to_user_id","=",$loginUser->id)->where("to_deleted","=",0)->orderBy("created_at","desc");

        /*联查子查询再进行排序*/
        $messages = DB::table(DB::raw("({$subQuery->toSql()}) as t "))
            ->mergeBindings($subQuery->getQuery())
            ->select("*")
            ->groupBy("from_user_id")
            ->orderBy("created_at","desc")
            ->paginate(10);

        $messages->map(function($message) {
            $message->fromUser = User::find($message->from_user_id);
        });

        return view('theme::message.index')->with('messages',$messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loginUser = $request->user();
        $toUser = User::find($request->input('to_user_id'));
        if(!$toUser){
            abort(404);
        }

        $this->validate($request,$this->validateRules);
        $data = [
            'from_user_id'      => $loginUser->id,
            'to_user_id'      => $toUser->id,
            'content'  => $request->input('content')
        ];

        $message = Message::create($data);

        if($message){
            return $this->success(route('auth.message.show',['user_id'=>$toUser->id]),'消息发送成功');
        }

        return  $this->error("消息发送失败，请稍后再试",route('website.index'));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $toUser = User::find($user_id);
        if(!$toUser){
            abort(404);
        }

        /*设置该对话全部未读为已读*/
        Message::where('to_user_id','=',Auth()->user()->id)->where('is_read','=',0)->update(['is_read'=>1]);

        $messages = Message::where(function($query) use ($toUser) {
                                $query->where('to_user_id','=',Auth()->user()->id)
                                      ->where('from_user_id','=',$toUser->id)
                                      ->where('to_deleted','=',0);
                    })->orWhere(function($query) use ($toUser) {
                                $query->where('to_user_id','=',$toUser->id)
                                      ->where('from_user_id','=',Auth()->user()->id)
                                      ->where('from_deleted','=',0);
                   })->orderBy('created_at','desc')->paginate(10);


        return view('theme::message.show')->with('toUser',$toUser)->with('messages',$messages);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $loginUser = $request->user();
        $message = Message::find($id);

        if(!$message){
            abort(404);
        }


        /*收件人删除*/
        if( $message->to_user_id === $loginUser->id )
        {
            $message->to_deleted = 1;
            $message->save();
        }else if( $message->from_user_id === $loginUser->id ){
            $message->from_deleted = 1;
            $message->save();
        }else{
            return response('error');
        }

        /*删除双方都删除过的信息*/
        if( $message->to_deleted == 1 && $message->from_deleted == 1 ){
            $message->delete();
        }

        return response('ok');

    }

    public function destroySession(Request $request,$from_user_id)
    {

        $loginUser = $request->user();

        /*删除给我的消息*/

        Message::where('to_user_id','=',$loginUser->id)
               ->where('from_user_id','=',$from_user_id)
               ->update(['to_deleted'=>1]);

        /*删除我发的消息*/
        Message::where('to_user_id','=',$from_user_id)
            ->where('from_user_id','=',$loginUser->id)
            ->update(['from_deleted'=>1]);


        /*删除双方都删除的所有消息*/

        Message::where('to_deleted','=',1)->where('from_deleted','=',1)->delete();

        return response('ok');


    }


}
