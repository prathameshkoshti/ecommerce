<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Product;
use App\Category;
use App\Order;
use App\Quantity;

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
		$accessory_id = Category::where([
			['name', 'Accessory'],
			['status', 1],
		])->pluck('id')->first();
		$products = collect([]);

		$max_orders = Order::all();
		$orders = $max_orders->sortByDesc('ordered_quantity')->groupBy('quantity_id')->flatten()->unique('quantity_id')->pluck('quantity_id');

		$quantity_collection = collect([]);

		foreach($orders as $quantity_id) {
			$quantity = Quantity::where([
				['status', 1],
				['id', $quantity_id],
			])->get();

			$quantity_collection->push($quantity);
		}
		$quantities = $quantity_collection->flatten()->unique('product_id')->take(3);
		$profile = Auth::user();
		if($profile)
			if($profile->isAdmin == 1)
				return view('admin.home');
			else
				return view('users.home', compact('quantities'));
		else
			return view('users.home', compact('quantities'));
	}
}
