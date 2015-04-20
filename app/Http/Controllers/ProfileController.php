<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2015/4/20
 * Time: 10:54
 */

namespace App\Http\Controllers;


use App\Http\Requests\Request;

class ProfileController extends Controller{

    public function index(Request $request)
    {

        return view('theme::profile.index');

    }

} 