<?php
/**
 * Created by PhpStorm.
 * User: sdf_sky
 * Date: 2017/4/24
 * Time: 下午7:01
 */

namespace App\Console\Commands;


use App\Models\Answer;
use App\Models\Question;
use App\Services\QuestionService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AdoptAnswer extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adoptAnswer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'auto adopt answer';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment('start to adopt answer');
        $answerAdoptPeriod =  Setting()->get('answer_adopt_period',0);
        if( $answerAdoptPeriod > 0 ){
            $startTime = Carbon::createFromTimestamp(Carbon::today()->timestamp - $answerAdoptPeriod * 24*3600);
            $questions = Question::where("price",">",0)->where("created_at","<",$startTime)->where("status","=",1)->where("answers",'>',0)->orderBy('created_at','asc')->take(30)->get();
            $this->comment('total question:'.$questions->count());
            foreach( $questions as $question ){
                $this->comment('doing question id: '.$question->id);
                $answers = $question->answers()->whereNull('adopted_at')->where("status",">",0)->orderBy("supports",'desc')->orderBy("created_at","asc")->take(30)->get();
                $this->comment('question['.$question->id.']total answers:'.$answers->count());
                if( $answers->count() == 0 ){
                    continue;
                }

                $bestAnswerId = null;
                /*优先采纳专家答案*/
                foreach( $answers as $answer ){
                    if($answer->userData && $answer->userData->authentication_status == 1){
                        $bestAnswerId = $answer->id;
                    }
                }

                if(!$bestAnswerId){
                    $bestAnswerId = $answers[0]->id;
                }

                if($bestAnswerId){
                    $this->comment('best answer id: '.$bestAnswerId);
                    QuestionService::adoptAnswer($bestAnswerId);
                }

            }
        }
        $this->comment('finished!');
    }
}