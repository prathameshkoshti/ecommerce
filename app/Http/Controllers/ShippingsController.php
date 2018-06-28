<?php

namespace App\Http\Controllers;

use App\User;
use App\Shipping;
use Auth;
use Illuminate\Http\Request;

class ShippingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$shippings = Shipping::all();
		return view('admin.shippings.index', compact('shippings'));
	}

	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$users = User::where([
			['isAdmin', 0],
			['status', 1],
		])->get();
		$states = require_once(base_path().'/resources/views/libraries/states.php');
		return view('admin.shippings.create', compact('users', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request,[
			'address' => 'required',
			'user' => 'required',
			'city' => 'required',
			'state' => 'required',
			'pincode' => 'required|numeric|digits:6',
		]);

		Shipping::create([
			'user_id' => request('user'),
			'address' => request('address'),
			'landmark' => request('landmark'),
			'city' => request('city'),
			'state' => request('state'),
			'pincode' => request('pincode'),
			'status' => $request->status == 'on' ? 1 : 0,
			'created_by' => Auth::user()->id,
			'updated_by' => Auth::user()->id,
		]);

		\Session::flash('success', 'New shipping address created for user');
		return redirect('/admin/shippings');
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$shipping = Shipping::find($id);

		if(!$shipping)
		{
			\Session::flash('danger', 'No shipping address found having the id: '.$id);
			return redirect('/admin/shippings');
		}
		$other_addresses = Shipping::where([
			['user_id', '=', $shipping->user->id],
			['id', '!=', $id],
			])->get();
		return view('admin.shippings.view', compact('shipping', 'other_addresses'));
	}

	/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$users = User::where([
			['isAdmin', 0],
			['status', 1],
		])->get();
		$states = require_once(base_path().'/resources/views/libraries/states.php');
		$shipping = Shipping::find($id);
		if($shipping)
			return view('admin.shippings.edit', compact('shipping', 'users', 'states'));
		else
		{
			\Session::flash('danger', 'No shipping address found having the id: '.$id);
			return redirect('/admin/shippings');
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
		$shipping = Shipping::find($id);

		if(!$shipping)
		{
			\Session::flash('danger', 'No shipping address found having the id: '.$id);
			return redirect('/admin/shippings');
		}

		$this->validate($request, [
			'address' => 'required',
			'user' => 'required',
			'city' => 'required',
			'state' => 'required',
			'pincode' => 'required|numeric|digits:6',
		]);

		$shipping->user_id = $request->user;
		$shipping->address = $request->address;
		$shipping->landmark = $request->landmark;
		$shipping->city = $request->city;
		$shipping->state = $request->state;
		$shipping->pincode = $request->pincode;
		$shipping->status = $request->status == 'on' ? 1 : 0;
		$shipping->updated_by = Auth::user()->id;

		$shipping->save();

		\Session::flash('success', 'Shipping address for user:'.$shipping->user->name.' updated successfully!');
		return redirect('/admin/shippings');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$shipping = Shipping::find($id);

		if(!$shipping)
		{
			\Session::flash('danger', 'No shipping address found having the id: '.$id);
			return redirect('/admin/shippings');
		}

		$shipping->status = 0;
		$shipping->updated_by = Auth::user()->id;
		$shipping->save();

		\Session::flash('warning', 'Shipping address for user:'.$shipping->user->name.' deleted successfully!');
		return redirect('/admin/shippings');
    }
}
