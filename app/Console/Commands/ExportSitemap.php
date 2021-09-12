<?php

namespace App\Console\Commands;

use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExportSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:sitemap {date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '导出sitemap excel模板';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = $this->argument('date','');
        $startTime = Carbon::yesterday();
        $endTime = Carbon::today();
        if($date){
            $startTime = $date.' 00:00:00';
            $endTime = $date.' 23:59:59';
        }
        $this->comment("start to export sitemap");

        $xml = new \DOMDocument("1.0",'UTF-8');
        $xml->formatOutput = true;
        $document = $xml->createElement('DOCUMENT');
        $ask = $xml->createElement('bytedance_ask');
        $questions = Question::where("created_at",">",$startTime)->where("created_at","<",$endTime)->take(500)->get();
        foreach ($questions as $question){
            $item = $xml->createElement("item");
            $questionNode = $xml->createElement("question");
            $questionTitle = $xml->createElement("question_title");
            $questionTitleText = $xml->createTextNode($question->title);
            $questionTitle->appendChild($questionTitleText);
            $questionContent = $xml->createElement("question_content");
            $questionContentText = $xml->createTextNode(strip_tags($question->description));
            $questionContent->appendChild($questionContentText);
            $questionNode->appendChild($questionTitle);
            $questionNode->appendChild($questionContent);

            $answerNum = $xml->createElement("answer_num");
            $answerNumText = $xml->createTextNode($question->answers()->count());
            $answerNum->appendChild($answerNumText);
            $item->appendChild($questionNode);
            $item->appendChild($answerNum);

            $answerList = $xml->createElement("answer_list");
            foreach ($question->answers()->orderBy("created_at","asc")->take(50)->get() as $answer){
                $answerNode = $xml->createElement("answer");
                $isBest = $xml->createElement("is_best");
                $isAdopted = 'false';
                if($answer->adopted_at){
                    $isAdopted = 'true';
                }
                $isBestText = $xml->createTextNode($isAdopted);
                $isBest->appendChild($isBestText);

                $answerDate = $xml->createElement("answer_date");
                $answerDateText = $xml->createTextNode($answer->created_at->timestamp);
                $answerDate->appendChild($answerDateText);

                $answerContent = $xml->createElement("answer_content");
                $answerContentText = $xml->createTextNode(strip_tags($answer->content));
                $answerContent->appendChild($answerContentText);

                $answerNode->appendChild($isBest);
                $answerNode->appendChild($answerDate);
                $answerNode->appendChild($answerContent);
                $answerList->appendChild($answerNode);
            }
            $item->appendChild($answerList);

            $url = $xml->createElement("url");
            $urlText = $xml->createTextNode(route('ask.question.detail',['id'=>$question->id],true));
            $url->appendChild($urlText);
            $item->appendChild($url);
            $ask->appendChild($item);
        }

        $document->appendChild($ask);
        $xml->appendChild($document);
        $xml->save(public_path(substr($startTime,0,10).'.xml'));
        $this->comment("finished");
        return true;

    }
}
