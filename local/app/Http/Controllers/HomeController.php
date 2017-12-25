<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql = "SELECT exchange.step, exchange.id, usera.name as usera, userb.name as userb FROM exchange, users as usera, users as userb WHERE usera.id = exchange.userid_a AND exchange.userid_b = userb.id ORDER BY exchange.id DESC";
        $data["exchange"] = DB::select($sql);
        return view('home',$data);
    }
}
