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
		$users = User::all();
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
			'updated_by' => Auth::user()->id,
		]);

		\Session::flash('success', 'User: '.$request->name.' added successfully!');
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
			\Session::flash('danger', 'No user found having the id '.$id.'!');
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
			\Session::flash('danger', 'No user found having the id '.$id.'!');
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
			\Session::flash('danger', 'No user found having the id '.$id.'!');
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
		$user->status = $request->status == 'on' ? 1 : 0;

		if(request('password'))
		{
			$this->validate($request, [
				'password' => 'required|min:5|max|100',
			]);
			$user->password = bcrypt(request('password'));
		}
		$user->save();
		\Session::flash('success', 'User: '.$request->name.' updated successfully!');
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
			\Session::flash('danger', 'No user found having the id '.$id.'!');
			return redirect('admin/users');
		}
		$user->status = 0;
		$user->updated_by = Auth::user()->id;

		$user->save();

		\Session::flash('warning', 'User: '.$user->name.' deleted successfully!');
		return redirect('admin/users');
    }
}
