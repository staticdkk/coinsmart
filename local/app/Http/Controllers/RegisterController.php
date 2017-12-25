<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class RegisterController extends Controller
{
    public function getRegister()
    {
    	if (Auth::guest()) {
			return view('admin.register');
		}else {
			return redirect(url("/home"));
		}
    }

    public function postRegister(Request $request)
    {
    	if ($request['password'] != $request['cpassword']){
			return redirect(url("/register"));
    	}
    	$data = [
			'name' => $request['username'],
			'password' => bcrypt($request['password']),
			'email' => $request['email'],
			'is_free' => 1,
			'current_message_id' => 0,
		];

		User::create($data);

		return redirect(url("/login"));
    }
}
