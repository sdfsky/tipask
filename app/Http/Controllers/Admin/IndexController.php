<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use App\Models\Article;
use App\Models\Question;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class IndexController extends AdminController
{
    /**
     *显示后台首页
     */
    public function index()
    {
        $totalUserNum = User::count();
        $totalQuestionNum = Question::count();
        $totalArticleNum = Article::count();
        $totalAnswerNum = Answer::count();
        $userChart = $this->drawUserChart();
        $questionChart = $this->drawQuestionChart();
        $systemInfo = $this->getSystemInfo();
        return view("admin.index.index")->with(compact('totalUserNum','totalQuestionNum','totalArticleNum','totalAnswerNum','userChart','questionChart','systemInfo'));
    }


    /*显示或隐藏sidebar*/
    public function sidebar(Request $request){
        Cookie::forget('sidebar_collapse');
        $cookie = Cookie::forever('sidebar_collapse',$request->get('collapse'));
        return response()->json('ok')->withCookie($cookie);
    }


    private function drawUserChart()
    {

        /*生成Labels*/
        $labelTimes = $chartLabels = [];

        for( $i=0 ; $i < 7 ; $i++ ){
            $labelTimes[$i] = Carbon::createFromTimestamp( Carbon::today()->timestamp - (6-$i) * 24 * 3600 );
            $chartLabels[$i] = '"'.$labelTimes[$i]->month.'月-'.$labelTimes[$i]->day.'日'.'"';
        }

        $nowTime = Carbon::now();

        $users = User::where('created_at','>',$labelTimes[0])->where('created_at','<',$nowTime)->get();

        $registerRange = $verifyRange = $authRange = [0,0,0,0,0,0,0];

        for( $i=0 ; $i < 7 ; $i++ ){
            $startTime = $labelTimes[$i];
            $endTime = $nowTime;
            if(isset($labelTimes[$i+1])){
                $endTime = $labelTimes[$i+1];
            }
            foreach($users as $user){
                if( $user->created_at > $startTime && $user->created_at < $endTime ){
                    $registerRange[$i]++;
                    if( $user->status > 0 ){
                        $verifyRange[$i]++;
                    }

                    if($user->userData && $user->userData->authentication_status === 1){
                        $authRange[$i]++;
                    }
                }
            }

        }

        return ['labels'=>$chartLabels,'registerUsers'=>$registerRange,'verifyUsers'=>$verifyRange,'authUsers'=>$authRange];
    }

    private function drawQuestionChart()
    {

        /*生成Labels*/
        $labelTimes = $chartLabels = [];
        for( $i=0 ; $i < 7 ; $i++ ){
            $labelTimes[$i] = Carbon::createFromTimestamp( Carbon::today()->timestamp - (6-$i) * 24 * 3600 );
            $chartLabels[$i] = '"'.$labelTimes[$i]->month.'月-'.$labelTimes[$i]->day.'日'.'"';
        }

        $nowTime = Carbon::now();


        $questions = Question::where('created_at','>',$labelTimes[0])->where('created_at','<',$nowTime)->get();
        $answers = Answer::where('created_at','>',$labelTimes[0])->where('created_at','<',$nowTime)->get();
        $articles = Article::where('created_at','>',$labelTimes[0])->where('created_at','<',$nowTime)->get();

        $questionRange = $answerRange = $articleRange = [0,0,0,0,0,0,0];

        for( $i=0 ; $i < 7 ; $i++ ){
            $startTime = $labelTimes[$i];
            $endTime = $nowTime;
            if(isset($labelTimes[$i+1])){
                $endTime = $labelTimes[$i+1];
            }

            /*问题统计*/
            foreach($questions as $question){
                if( $question->created_at > $startTime && $question->created_at < $endTime ){
                    $questionRange[$i]++;
                }
            }

            /*回答统计*/
            foreach($answers as $answer){
                if( $answer->created_at > $startTime && $answer->created_at < $endTime ){
                    $answerRange[$i]++;
                }
            }
            /*文章统计*/
            foreach($articles as $article){
                if( $article->created_at > $startTime && $article->created_at < $endTime ){
                    $articleRange[$i]++;
                }
            }

        }

        return [
            'labels'  => $chartLabels,
            'questionRange' => $questionRange,
            'answerRange' => $answerRange,
            'articleRange' => $articleRange,
        ];

    }


    private function getSystemInfo()
    {
        $systemInfo['phpVersion'] = PHP_VERSION;
        $systemInfo['runOS'] = PHP_OS;
        $systemInfo['maxUploadSize'] = ini_get('upload_max_filesize');
        $systemInfo['maxExecutionTime'] = ini_get('max_execution_time');
        $systemInfo['hostName'] = '';
        if(isset($_SERVER['SERVER_NAME'])){
            $systemInfo['hostName'] .= $_SERVER['SERVER_NAME'].' / ';
        }
        if(isset($_SERVER['SERVER_ADDR'])){
            $systemInfo['hostName'] .= $_SERVER['SERVER_ADDR'].' / ';
        }
        if(isset($_SERVER['SERVER_PORT'])){
            $systemInfo['hostName'] .= $_SERVER['SERVER_PORT'];
        }
        $systemInfo['serverInfo'] = '';
        if(isset($_SERVER['SERVER_SOFTWARE'])){
            $systemInfo['serverInfo'] = $_SERVER['SERVER_SOFTWARE'];
        }
        return $systemInfo;
    }


}
