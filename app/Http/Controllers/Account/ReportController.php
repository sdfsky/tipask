<?php

namespace App\Http\Controllers\Account;

use App\Models\Answer;
use App\Models\Article;
use App\Models\Question;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * 举报问题、文章、回答等
     * @param  \Illuminate\Http\Request $request
     * @return
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $source_id = $requestData['source_id'];
        $source_type = $requestData['source_type'];
        $subject = '';
        if ($source_type == 'question') {
            $source = Question::find($source_id);
            $subject = $source->title;
        } else if ($source_type == 'article') {
            $source = Article::find($source_id);
            $subject = $source->title;
        } else if ($source_type == 'answer') {
            $source = Answer::find($source_id);
            $subject = str_limit(strip_tags($source->content), 255);
        }

        if ( !$source) {
            abort(404);
        }

        // 同一类型、同一用户举报限制三次
        $count = Report::where('user_id',$request->user()->id)->where('source_type',get_class($source))->where('source_id',$source_id)->count();
        if ($count >= 3){
            if ($source_type == 'question'){
                return $this->error(route('ask.question.detail',['id'=>$source_id]),'您已举报超过三次，请耐心等待管理员处理');
            }elseif ($source_type == 'article'){
                return $this->error(route('blog.article.detail',['id'=>$source_id]),'您已举报超过三次，请耐心等待管理员处理');
            }elseif ($source_type == 'answer'){
                return $this->error(route('ask.question.detail',['id'=>$source->question_id]),'您已举报超过三次，请耐心等待管理员处理');
            }
        }

        $data = [
            'user_id'     => $request->user()->id,
            'source_id'   => $source_id,
            'subject'     => $subject,
            'source_type' => get_class($source),
            'report_type' => $request->input('report_type'),
            'reason'      => $request->input('reason', ''),
        ];
        Report::create($data);
        if ($source_type == 'question'){
            return $this->success(route('ask.question.detail',['id'=>$source_id]),'举报成功！');
        }elseif ($source_type == 'article'){
            return $this->success(route('blog.article.detail',['id'=>$source_id]),'举报成功！');
        }elseif ($source_type == 'answer'){
            return $this->success(route('ask.question.detail',['id'=>$source->question_id]),'举报成功！');
        }
    }
}
