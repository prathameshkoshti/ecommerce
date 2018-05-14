<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
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
	    	$user = User::find($request->id);
	    	$user->name = $request->name;
	    	$user->email = $request->email;
		$user->mobile_no = $request->mobile_no;
		$user->updated_by = Auth::user()->id;
		$user->save();

		\Session::flash('update', 'Profile Updated Successfully');
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
    public function updatePassword(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
