<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchAjax extends Controller
{
	public function dataAjaxU(Request $request)
	{
		$data = [];

		if($request->has('q')){
			$search = $request['q'];
			$data = DB::table("users")->select("id","name")
				                      ->where("is_free","=","1")
				                      ->where("status","=","0")
				                      ->where("name","like","%$search%")
			                          ->get();
		}

		return response()->json($data);
	}

	public function dataAjaxM(Request $request)
	{
		$data = [];

		if($request->has('q')){
			$search = $request['q'];
			$data = DB::table("users")->select("id","name")
				                      ->where("is_free","=","-1")
				                      ->where("status","=","0")
				                      ->where("name","like","%$search%")
			                          ->get();
		}

		return response()->json($data);
	}
}
