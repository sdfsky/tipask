<?php
/**
 * 用户空间
 */
namespace App\Http\Controllers\Account;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SpaceController extends Controller
{
    /**
     * 用户空间首页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::find(1)->data();
        echo $data->user_id;
        //echo $data->questions;
        return view('theme::space.index');
    }

    public function answers()
    {

        return view('theme::space.answers');

    }

    public function questions()
    {

        return view('theme::space.questions');

    }



}
