<?php

namespace App\Http\Controllers\Ask;

use App\models\Tag;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * tag显示页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name,$source_type='questions')
    {
        $tag = Tag::where('name','=',$name)->first();
        if(!$tag){
            abort(404);
        }


        $sources = [];
        if($source_type=='questions'){
            $sources = $tag->questions()->paginate(10);
        }else if($source_type=='articles'){
            $sources = $tag->articles()->paginate(10);
        }

        return view('theme::tag.index')->with('tag',$tag)->with('sources',$sources)->with('source_type',$source_type);
    }

}
