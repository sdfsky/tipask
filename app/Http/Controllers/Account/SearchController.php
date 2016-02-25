<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$filter='questions')
    {

        $validator = Validator::make($request->all(), [
            'word' => 'required|max:128',
        ]);

        if ($validator->fails())
        {
             $this->error(route('website.index'),'搜索关键词不能为空');
        }

        $word = trim($request->input('word'));
        $model =  App::make('App\Models\\'.ucfirst(str_singular($filter)));
        $list = $model::search($word);
        return view('theme::search.index')->with('word',$word)->with('filter',$filter)->with('list',$list);
    }


}
