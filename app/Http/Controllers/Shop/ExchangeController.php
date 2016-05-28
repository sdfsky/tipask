<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exchanges = Auth()->user()->exchanges()->paginate(20);
        return view('theme::goods.exchanges')->with(compact('exchanges'));
    }


}
