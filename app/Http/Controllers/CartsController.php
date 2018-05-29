<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Cart;
use App\User;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$users = User::where('isAdmin', 0)->get();
		return view('admin.carts.index', compact('users'));
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$cart = Cart::where([
			['user_id', $id],
			['status', 1]
			])->get();
		$user = User::find($id);
		if($cart)
			return view('admin.carts.view', compact('cart', 'user'));
		else
		{
			\Session::flash('danger', 'No cart found for user: '.$user->name);
			return redirect('/admin/carts');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);
		if(!$cart)
		{
			\Session::flash('danger', 'No cart found having the id: '.$id);
			return redirect('/admin/carts');
		}

		$cart->status = 0;
		$cart->updated_by = Auth::user()->id;

		$cart->save();

		\Session('warning', 'Product: '.$cart->product->name.' from '.$cart->user->name.'\'s cart deleted successfully!');
		return redirect('/admin/carts/view/'.$cart->user_id);
    }
}
