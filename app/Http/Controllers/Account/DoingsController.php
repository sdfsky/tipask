<?php

namespace App\Http\Controllers\Account;

use App\Models\Doing;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DoingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$filter='newest')
    {
        $query = null;
        if($filter=='concerned'){
            $query = Doing::concerned($request->user());
        }else{
            $query = Doing::newest();
        }
        $doings = $query->paginate(20);
        $doings->map(function($doing){
            $doing->action_text = Config::get('tipask.user_actions.'.$doing->action);
        });
        return view('theme::doing.index')->with(compact('filter','doings'));
    }

}
