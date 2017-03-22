<?php

namespace App\Http\Controllers\Ask;

use App\Models\Tag;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * tag显示页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id,$source_type='questions')
    {
        $tag = Tag::findOrFail($id);
        $sources = [];
        if($source_type=='questions'){
            $sources = $tag->questions()->orderBy('created_at','desc')->paginate(15);
        }else if($source_type=='articles'){
            $sources = $tag->articles()->orderBy('created_at','desc')->paginate(15);
        }
        $followers = $tag->followers()->orderBy('user_data.credits','desc')->orderBy('user_data.supports','desc')->take(10)->get();
        return view('theme::tag.index')->with('tag',$tag)
                                       ->with('sources',$sources)
                                       ->with('followers',$followers)
                                       ->with('source_type',$source_type);
    }

}
