<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function show()
	{
	   	return view('admin.profile');
    	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    	public function updateProfile(Request $request)
    	{
	    	$user = User::find(Auth::user()->id);
	    	$user->name = $request->name;
	    	$user->email = $request->email;
			$user->mobile_no = $request->mobile_no;
			$user->updated_by = Auth::user()->id;
			$user->save();

			\Session::flash('success', 'Profile updated successfully');
			return redirect('/admin/profile');
    	}

	/**
		* Show the form for editing the specified resource.
		*
		* @param  int  $id
		* @return \Illuminate\Http\Response
	*/
	public function changePassword()
	{
		return view('admin.change_password');
	}

	/**
		* Update the specified resource in storage.
		*
		* @param  \Illuminate\Http\Request  $request
		* @param  int  $id
		* @return \Illuminate\Http\Response
		*/
	public function updatePassword(Request $request)
	{
		$this->validate($request, [
			'new_password' => 'required|min:5',
			'old_password' => 'required|min:5',
		]);
		if(Hash::check($request->old_password, Auth::user()->password))
		{
			Auth::user()->password = bcrypt($request->new_password);
			Auth::user()->save();
			\Session::flash('success', 'Password updated successfully!');
			return redirect('/admin/change_password');
		}
		else
		{
			\Session::flash('danger', 'Old password incorrect!');
			return redirect('/admin/change_password');
		}
	}

}
