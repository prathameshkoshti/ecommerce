<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		if(Auth::user())
			$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$profile = Auth::user();
		if($profile)
			if($profile->isAdmin == 1)
				return view('admin.home');
			else
				return view('users.home');
		else
			return view('users.home');
	}
}
