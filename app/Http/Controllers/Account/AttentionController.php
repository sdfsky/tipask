<?php

namespace App\Http\Controllers\Account;

use App\Models\Attention;
use App\Models\Question;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AttentionController extends Controller
{

    /**
     * 添加模型的关注包含问题、用户等
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($source_type,$source_id,Request $request)
    {

        if($source_type === 'question'){
            $source  = Question::find($source_id);
            $subject = $source->title;
        }else if($source_type === 'article'){

        }

        if(!$source){
            abort(404);
        }


        /*再次关注相当于是取消关注*/
        $attention = Attention::where("user_id",'=',$request->user()->id)->where('source_type','=',get_class($source))->where('source_id','=',$source_id)->first();
        if($attention){
            $attention->delete();
            $source->decrement('followers');
            return response('unfollowed');
        }

        $data = [
            'user_id'     => $request->user()->id,
            'source_id'   => $source_id,
            'source_type' => get_class($source),
            'subject'  => $subject,
        ];

        $attention = Attention::create($data);

        if($attention){
            switch($source_type){
                case 'question' :
                    $this->notify($request->user()->id,$source->user_id,'follow_question',$subject,$source->id);
                    $this->doing($request->user()->id,'follow_question',get_class($source),$source_id,$subject);
                    break;
                case 'user':
                    break;
            }
            $source->increment('followers');
        }

        return response('followed');


    }



    /*关注的问题*/
    public function sources($source_type,Request $request)
    {

        $attentions = Question::join('attentions',function($join) use ($request) {
            $join->on('questions.id','=','attentions.source_id')
                 ->where('attentions.source_type','=','App\Models\Question')
                 ->where('attentions.user_id','=',$request->user()->id);
        })->select("questions.*")->paginate(10);
        return view('theme::attention.sources')->with($source_type,$attentions)->with('source_type',$source_type);

    }



}
