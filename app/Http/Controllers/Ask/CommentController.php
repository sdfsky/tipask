<?php

namespace App\Http\Controllers\Ask;

use App\Models\Answer;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Question;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CommentController extends Controller
{

    /*问题创建校验*/
    protected $validateRules = [
        'content' => 'required|max:10000',
    ];

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,$this->validateRules);

        $source_type = $request->input('source_type');
        $source_id = $request->input('source_id');
        if($source_type === 'question'){
            $source  = Question::find($source_id);
            $notify_subject = $source->title;
            $notify_type = 'comment_question';
            $notify_refer_type = 'question';
            $notify_refer_id = 0;
        }else if($source_type === 'answer'){
            $source = Answer::find($source_id);
            $notify_subject = $source->content;
            $notify_type = 'comment_answer';
            $notify_refer_type = 'answer';
            $notify_refer_id = $source->question_id;

        }else if($source_type === 'article'){
            $source = Article::find($source_id);
            $notify_subject = $source->title;
            $notify_type = 'comment_article';
            $notify_refer_type = 'article';
            $notify_refer_id = 0;
        }

        if(!$source){
            abort(404);
        }


        $data = [
            'user_id'     => $request->user()->id,
            'content'     => $request->input('content'),
            'source_id'   => $source_id,
            'source_type' => get_class($source),
            'to_user_id'  => $request->input('to_user_id'),
            'status'      => 1,
            'supports'    => 0
        ];


        $comment = Comment::create($data);
        /*问题、回答、文章评论数+1*/
        $comment->source()->increment('comments');

        if( $comment->to_user_id > 0 ){
            $this->notify($request->user()->id,$comment->to_user_id,'reply_comment',$notify_subject,$source_id,$comment->content,$notify_refer_type,$notify_refer_id);

        }else{
            $this->notify($request->user()->id,$source->user_id,$notify_type,$notify_subject,$source_id,$comment->content,$notify_refer_type,$notify_refer_id);
        }


        return view('theme::comment.item')->with('comment',$comment)
                                            ->with('source_type',$source_type)
                                            ->with('source_id',$source_id);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($source_type,$source_id)
    {
        if($source_type === 'question'){
            $source = Question::find($source_id);
        }else if($source_type === 'answer'){
            $source = Answer::find($source_id);
        }else if($source_type === 'article'){
            $source = Article::find($source_id);
        }

        if(!$source){
            abort(404);
        }
        $comments = $source->comments()->orderBy('supports','desc')->orderBy('created_at','asc')->simplePaginate(15);

       return view('theme::comment.paginate')->with('comments',$comments)
                                         ->with('source_type',$source_type)
                                         ->with('source_id',$source_id);
    }

}
