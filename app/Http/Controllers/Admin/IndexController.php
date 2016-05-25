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
        return view("admin.index.index")->with(compact('totalUserNum','totalQuestionNum','totalArticleNum','totalAnswerNum','userChart'));
    }


    /*显示或隐藏sidebar*/
    public function sidebar(Request $request){
        Cookie::forget('sidebar_collapse');
        $cookie = Cookie::forever('sidebar_collapse',$request->get('collapse'));
        return response()->json('ok')->withCookie($cookie);
    }


    private function drawUserChart()
    {


        $label1Time =   Carbon::createFromTimestamp( Carbon::now()->timestamp - 7 * 24 * 3600 );
        $labels[] = '"'.$label1Time->month.'月-'.$label1Time->day.'日'.'"';

        $label2Time = Carbon::createFromTimestamp( Carbon::now()->timestamp - 6 * 24 * 3600 );
        $labels[] = '"'.$label2Time->month.'月-'.$label2Time->day.'日'.'"';

        $label3Time = Carbon::createFromTimestamp( Carbon::now()->timestamp - 5 * 24 * 3600 );
        $labels[] = '"'.$label3Time->month.'月-'.$label3Time->day.'日'.'"';

        $label4Time = Carbon::createFromTimestamp( Carbon::now()->timestamp - 4 * 24 * 3600 );
        $labels[] = '"'.$label4Time->month.'月-'.$label4Time->day.'日'.'"';

        $label5Time = Carbon::createFromTimestamp( Carbon::now()->timestamp - 3 * 24 * 3600 );
        $labels[] = '"'.$label5Time->month.'月-'.$label5Time->day.'日'.'"';

        $label6Time = Carbon::createFromTimestamp( Carbon::now()->timestamp - 2 * 24 * 3600 );
        $labels[] = '"'.$label6Time->month.'月-'.$label6Time->day.'日'.'"';

        $label7Time = Carbon::createFromTimestamp( Carbon::now()->timestamp - 1 * 24 * 3600 );
        $labels[] = '"'.$label7Time->month.'月-'.$label7Time->day.'日'.'"';

        $users = User::where('created_at','>=',$label1Time)->get();



        $registerNum1 = $registerNum2 = $registerNum3 = $registerNum4 = $registerNum5 = $registerNum6 = $registerNum7 = 0;
        $verifyNum1 = $verifyNum2 = $verifyNum3 = $verifyNum4 = $verifyNum5 = $verifyNum6 = $verifyNum7 = 0;
        $authNum1 = $authNum2 = $authNum3 = $authNum4 = $authNum5 = $authNum6 = $authNum7 = 0;
        foreach($users as $user){

            if( $user->created_at->timestamp > $label1Time->timestamp && $user->created_at->timestamp < $label2Time->timestamp ){

                $registerNum1++;

                if( $user->status > 0 ){
                    $verifyNum1++;
                }

                if($user->userData->authentication_status === 1){
                    $authNum1++;
                }

            }

            if( $user->created_at->timestamp > $label2Time->timestamp && $user->created_at->timestamp < $label3Time->timestamp ){

                $registerNum2++;

                if( $user->status > 0 ){
                    $verifyNum2++;
                }

                if($user->userData->authentication_status === 1){
                    $authNum2++;
                }

            }

            if( $user->created_at->timestamp > $label3Time->timestamp && $user->created_at->timestamp < $label4Time->timestamp ){

                $registerNum3++;

                if( $user->status > 0 ){
                    $verifyNum3++;
                }

                if($user->userData->authentication_status === 1){
                    $authNum3++;
                }

            }

            if( $user->created_at->timestamp > $label4Time->timestamp && $user->created_at->timestamp < $label5Time->timestamp ){

                $registerNum4++;

                if( $user->status > 0 ){
                    $verifyNum4++;
                }

                if($user->userData->authentication_status === 1){
                    $authNum4++;
                }

            }

            if( $user->created_at->timestamp > $label5Time->timestamp && $user->created_at->timestamp < $label6Time->timestamp ){

                $registerNum5++;

                if( $user->status > 0 ){
                    $verifyNum5++;
                }

                if($user->userData->authentication_status === 1){
                    $authNum5++;
                }

            }

            if( $user->created_at->timestamp > $label6Time->timestamp && $user->created_at->timestamp < $label7Time->timestamp ){

                $registerNum6++;

                if( $user->status > 0 ){
                    $verifyNum6++;
                }

                if($user->userData->authentication_status === 1){
                    $authNum6++;
                }

            }

            if( $user->created_at->timestamp > $label7Time->timestamp){

                $registerNum7++;

                if( $user->status > 0 ){
                    $verifyNum7++;
                }

                if($user->userData->authentication_status === 1){
                    $authNum7++;
                }

            }


        }

        $registerUsers= [$registerNum1,$registerNum2,$registerNum3,$registerNum4,$registerNum5,$registerNum6,$registerNum7];
        $verifyUsers = [$verifyNum1,$verifyNum2,$verifyNum3,$verifyNum4,$verifyNum5,$verifyNum6,$verifyNum7];
        $authentications = [$authNum1,$authNum2,$authNum3,$authNum4,$authNum5,$authNum6,$authNum7];
        return ['labels'=>$labels,'registerUsers'=>$registerUsers,'verifyUsers'=>$verifyUsers,'authUsers'=>$authentications];

    }


}
