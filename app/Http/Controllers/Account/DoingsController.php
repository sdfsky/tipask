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
    public function index(Request $request)
    {
        $doings = Doing::correlation($request->user())->paginate(20);
        $doings->map(function($doing){
            $doing->action_text = Config::get('tipask.user_actions.'.$doing->action);
        });
        return view('theme::doing.index')->with('doings',$doings);
    }

}
