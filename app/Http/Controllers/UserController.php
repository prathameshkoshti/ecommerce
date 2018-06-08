<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Wishlist;
use App\Cart;
use App\Order;

class UserController extends Controller
{
	public function getOrders()
	{
		$orders = Order::where([
			['status', 1],
			['user_id', Auth::user()->id],
		])->get();

		dd($orders);
		return view('users.orders.view');
	}

	public function getWishlist()
	{
		$wishlist = Wishlist::where([
			['status', 1],
			['user_id', Auth::user()->id],
		])->get();

		dd($wishlist);
		return view('users.wishlist.view');
	}

	public function getCart()
	{
		$cart = Cart::where([
			['status', 1],
			['user_id', Auth::user()->id],
		])->get();

		dd($cart);
		return view('users.cart.view');
	}

	public function getProfile()
	{
		$profile = Auth::user();
		return view('users.profile.view', compact('profile'));
	}

	public function editProfile()
	{
		$profile = Auth::user();
		dd($profile);
		return view('users.profile.edit', compact('profile'));
	}

	public function updateProfile()
	{
		$profile = Auth::user();
		dd($profile);
		return redirect('/users/profile', compact($profile));
	}
}
