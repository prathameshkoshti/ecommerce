<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$users = User::where('status', '=', 1)->get();
		return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email',
			'password' => 'required|max:100|min:5',
			'mobile_no' =>	'required|numeric',
		]);
		$user = User::create([
			'name' => request('name'),
			'email' => request('email'),
			'mobile_no' => request('mobile_no'),
			'password' => bcrypt(request('password')),
			'isAdmin' => ($request->isadmin == 'on' ? 1 : 0),
			'created_by' => Auth::user()->id,
		]);

		\Session::flash('create', 'User Added into the System.');
		return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$user = User::find($id);
		if($user)
			return view('admin.users.view', compact('user'));
		else
		{
			\Session::flash('delete', 'No user found with id '.$id.'!');
			return redirect('admin/users');
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$user = User::find($id);
		if($user)
			return view('admin.users.edit', compact('user'));
		else
		{
			\Session::flash('delete', 'No user found with id '.$id.'!');
			return redirect('admin/users');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$user = User::find($id);
		if(!$user)
		{
			\Session::flash('update', 'No user found with id '.$id.'!');
			return redirect('admin/users');
		}

		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email',
			'mobile_no' =>	'required|numeric',
		]);

		$user->name = request('name');
		$user->email = request('email');
		$user->mobile_no = request('mobile_no');
		$user->updated_by = Auth::user()->id;

		if(request('password'))
			$user->password = bcrypt(request('password'));

		$user->save();
		\Session::flash('update', 'User Info Updated Successfully!');
		return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$user = User::find($id);
		if(!$user)
		{
			\Session::flash('delete', 'No user found with id '.$id.'!');
			return redirect('admin/users');
		}
		$user->status = 0;
		$user->save();

		\Session::flash('delete', 'User Deleted Successfully!');
		return redirect('admin/users');
    }
}
