<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Question;
use App\models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       // echo intval(str_shuffle('0123456789'));
        $setting = Setting()->get('website.name');
      //  print_r($setting);


        return redirect(route('website.ask'));
    }


    /*问答模块*/
    public function ask($filter='newest')
    {

        $question = new Question();

        if(!method_exists($question,$filter)){
            abort(404);
        }

        $questions =  call_user_func([$question,$filter]);

        $hotQuestions = Question::recent();
        return view('theme::home.ask')->with('questions',$questions)
            ->with('hotQuestions',$hotQuestions)
            ->with('filter',$filter);
    }

    public function topic()
    {
        $topics = Tag::orderBy('followers','DESC')->paginate(20);
        return view('theme::home.topic')->with('topics',$topics);
    }

}
