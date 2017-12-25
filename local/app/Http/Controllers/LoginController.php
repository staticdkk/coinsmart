<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
	public function getLogin()
	{
		if (Auth::guest()) {
			return view('admin.login');
		}else {
			return redirect(url("/home"));
		}
	}

	public function postLogin(Request $request)
	{
		$data = [
			'name' => $request['username'],
			'password' => $request['password']
		];
        // var_dump ($data);
		if (Auth::attempt($data)) {
			return redirect(url("/home"));
			// echo "not ok";
		}else 
		return redirect(url("/login"));
			// echo "ok";
	}

	public function logOut()
	{
		Auth::logout();
		return redirect(url("login"));
	}
}
