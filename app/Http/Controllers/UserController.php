<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Wishlist;
use App\Cart;
use App\Order;
use App\Product;
use App\Shipping;
use App\Category;
use App\Material;
use App\Rating;
use App\Quantity;
use Hash;

class UserController extends Controller
{
	public function getProduct($id)
	{
		$product = Product::find($id);
		$sizes = Quantity::where([
			['status', 1],
			['product_id', $id],
			['quantity', '>', 0],
		])->get();
		return view('users.products.view', compact('product', 'sizes'));
	}

	public function getProductsByCategory($category)
	{
		if(Auth::check())
		{
			$wishlist = Wishlist::where([
				['status', 1],
				['user_id', Auth::user()->id],
			])->pluck('product_id');
		}

		if($category == 'all')
		{
			$category_id = Category::where('name', 'Accessory')->pluck('id')->first();
			$products = Product::where([
				['status', 1],
				['category_id', '!=', $category_id],
			])->get();
			return view('users.products.index', compact('products', 'category', 'wishlist', 'search_query'));
		}
		else
		{
			$categories_id = Category::where('name', 'like', '%'.$category.'%')->pluck('id');
			$products_collection = collect([]);
			foreach($categories_id as $id)
			{
				$products = Product::where('category_id', '=', $id)->get();
				foreach($products as $product)
				{
					$products_collection->push($product);
				}
			}
			$products = $products_collection->unique('name');
			return view('users.products.index', compact('products', 'category', 'wishlist', 'search_query'));
		}
	}

	public function getProductsBySearch($search_query)
	{
		if(Auth::check())
		{
			$wishlist = Wishlist::where([
				['status', 1],
				['user_id', Auth::user()->id],
			])->pluck('product_id');
		}

		$products_collection = Product::where([
			['status', 1],
			['name', 'like', '%'.$search_query.'%'],
		])->get();

		$categories_id = Category::where('name', 'like', '%'.$search_query.'%')->pluck('id');
		foreach($categories_id as $id)
		{
			$products = Product::where('category_id', '=', $id)->get();
			foreach($products as $product)
			{
				$products_collection->push($product);
			}
		}

		$materials_id = Category::where('name', 'like', '%'.$search_query.'%')->pluck('id');
		foreach($materials_id as $id)
		{
			$products = Product::where('material_id', '=', $id)->get();
			foreach($products as $product)
			{
				$products_collection->push($product);
			}
		}
		$category = 0;
		$products = $products_collection->unique('name');
		return view('users.products.index', compact('products', 'search_query', 'category', 'wishlist'));
	}

	public function getAccessories()
	{
		if(Auth::check())
		{
			$wishlist = Wishlist::where([
				['status', 1],
				['user_id', Auth::user()->id],
			])->pluck('product_id');
		}
		$category_id = Category::where('name', 'Accessory')->pluck('id')->first();
		$products = Product::where([
			['status', 1],
			['category_id', $category_id],
		])->get();

		// dd($products);
		return view('users.products.accessories', compact('products', 'wishlist'));
	}

	/*
		User Wishlist operations
	*/
	public function getWishlist()
	{
		$wishlist = Wishlist::where([
			['status', 1],
			['user_id', Auth::user()->id],
		])->latest()->paginate(12);

		return view('users.profile_settings.wishlist', compact('wishlist'));
	}

	public function removeFromWishlist($id) {
		$wishlist = Wishlist::find($id);
		if($wishlist) {
			if($wishlist->user_id == Auth::user()->id) {
				$wishlist->status = 0;
				$wishlist->updated_by = Auth::user()->id;
				$wishlist->save();
				\Session::flash('warning', 'Removed from wishlist!');
			}
			else {
				return view('errors.404');
			}
		}
		else
		{
			\Session::flash('danger', 'No item found with item: '.$id);
		}
		return redirect('my/wishlist');
	}
	public function addToWishlist($product_id)
	{
		$wishlist = Wishlist::where([
			['user_id', Auth::user()->id],
			['product_id', $product_id],
		])->first();

		if($wishlist)
		{
			if($wishlist->status == 0)
			{
				$wishlist->status = 1;
				$wishlist->updated_by = Auth::user()->id;
				$wishlist->save();
			}
			elseif($wishlist->status == 1)
			{
				\Session::flash('warning', 'Item: '.$wishlist->product->name.' is in your wishlist!');
				return redirect('/my/wishlist');
			}
		}
		else
		{
			$wishlist = Wishlist::create([
				'user_id' => Auth::user()->id,
				'product_id' => $product_id,
				'created_by' => Auth::user()->id,
				'updated_by' => Auth::user()->id,
			]);
		}
		\Session::flash('success', 'Item: '.$wishlist->product->name.' addedd to wishlist successfully!');
		return redirect('/my/wishlist');
	}


	/*
		User cart operations
	*/
	public function getCart()
	{
		$cart = Cart::where([
			['status', 1],
			['user_id', Auth::user()->id],
		])->latest()->get();

		return view('users.checkout.cart', compact('cart'));
	}

	public function updateCartQuantity(Request $request, $id)
	{
		$cart_item = Cart::find($id);
		if(!$cart_item)
		{
			\Session::flash('danger', 'Invalid Request');
			return redirect('/my/cart');
		}

		$quantity = $cart_item->quantity->quantity;
		$this->validate($request, [
			'quantity' => 'required|min:1|max:'.$quantity,
		]);

		$cart_item->ordered_quantity = $request->quantity;
		$cart_item->save();
		\Session::flash('success', 'Quantity Updated.');
		return redirect('/my/cart');
	}

	public function addToCart(Request $request, $product_id)
	{
		$this->validate($request, [
			'size' => 'required|numeric',
		]);
		$cart = Cart::where([
			['user_id', Auth::user()->id],
			['quantity_id', request('size')],
		])->get()->first();
		if($cart) {
			if($cart->status == 0){
				$cart->ordered_quantity = 1;
				$cart->status = 1;
				$cart->save();
			}
			elseif($cart->status == 1){
				$cart->ordered_quantity += 1;
				if($cart->ordered_quantity > $cart->quantity->quantity)
				{
					\Session::flash('warning', 'Quantity exceeded than the current stock');
					return redirect('/my/cart');
				}
				else
				{
					$cart->save();
				}
			}
		}
		else{
			$cart = Cart::create([
				'quantity_id' => $request->size,
				'user_id' => Auth::user()->id,
				'created_by' => Auth::user()->id,
				'updated_by' => Auth::user()->id,
				'ordered_quantity' => 1,
			]);
		}

		\Session::flash('success', 'Item: '.$cart->quantity->product->name.' added to cart');
		return redirect('/my/cart');
	}

	public function moveToWishlist($cart_id)
	{
		$cart_item = Cart::find($cart_id);

		$wishlist = Wishlist::where([
			['product_id', $cart_item->quantity->product->id],
			['user_id', Auth::user()->id],
		])->first();

		if($wishlist){
			if($wishlist->status == 0)
			{
				$cart_item->status = 0;
				$cart_item->updated_by = Auth::user()->id;
				$wishlist->status = 1;
				$wishlist->updated_by = Auth::user()->id;

				$wishlist->save();
				$cart_item->save();
			}
			elseif($wishlist->status = 1)
			{
				\Session::flash('warning', 'Item: '.$wishlist->product->name.' already in the wishlist!');
				return redirect('/my/cart');
			}
		}
		else
		{
			$wishlist = Wishlist::create([
				'user_id' => Auth::user()->id,
				'product_id' => $cart_item->quantity->product->id,
				'created_by' => Auth::user()->id,
				'updated_by' => Auth::user()->id,
			]);
			$cart_item->status = 0;
			$cart_item->updated_by = Auth::user()->id;
			$cart_item->save();
		}
		\Session::flash('success', 'Item: '.$wishlist->product->name.' added to wishlist successfully!');
		return redirect('/my/cart');
	}

	public function removeFromCart($id)
	{
		$cart_item = Cart::find($id);
		if(!$cart_item)
		{
			\Session::flash('damger', 'Invalid Request');
			return redirect('/my/cart');
		}

		$cart_item->status = 0;
		$cart_item->save();

		\Session::flash('warning', 'Item '.$cart_item->quantity->product->name.' removed from cart');
		return redirect('/my/cart');
	}

	/*
		Placing the order
	*/
	public function checkout()
	{
		$shippings = Shipping::where([
			['status', 1],
			['user_id', Auth::user()->id],
		])->get();

		$cart = Cart::where([
			['status', 1],
			['user_id', Auth::user()->id],
		])->get();

		$states = require_once(base_path().'/resources/views/libraries/states.php');

		if($cart)
			return view('users.checkout.checkout', compact('cart', 'shippings', 'states'));
		return redirect('/');
	}

	public function placeOrder(Request $request)
	{
		$this->validate($request, [
			'shipping' => 'required|numeric',
		]);

		$cart = Cart::where([
			['status', 1],
			['user_id', Auth::user()->id],
		])->get();

		$orders = collect([]);
		foreach($cart as $cart_item)
		{
			$order = Order::create([
				'quantity_id' => $cart_item->quantity_id,
				'user_id' => $cart_item->user_id,
				'shipping_id' => $request->shipping,
				'ordered_quantity' => $cart_item->ordered_quantity,
				'price' => $cart_item->quantity->product->price * $cart_item->ordered_quantity,
				'order_date' => date('Y-m-d'),
				'delivery_status' => 0,
				'created_by' => Auth::user()->id,
				'updated_by' => Auth::user()->id,
			]);
			$cart_item->status = 0;
			$cart_item->save();

			$orders->push($order);
		}

		\Session::flash('order_placed', 'Order Placed Successfully!');
		return redirect('/my/checkout/order_placed');
	}

	public function orderPlaced()
	{
		if(\Session::has('order_placed'))
			return view('users.checkout.order_placed');
		return redirect('/');
	}

	/*
		User Account Dashboard and its Settings
	*/
	public function getDashboard()
	{
		$shipping = Shipping::where([
			['status', 1],
			['user_id', Auth::user()->id]
		])->first();

		return view('users.profile_settings.dashboard', compact('shipping'));
	}

	public function getAccountInformation(Request $request)
	{
		$profile = Auth::user();
		return view('users.profile_settings.account_info', compact('profile'));
	}

	public function updateAccountInformation(Request $request)
	{
		$profile = Auth::user();

		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email',
			'mobile_no' => 'required|digits:10',
			'old_password' => 'required|max:100|min:5'
		]);

		if(Hash::check($request->old_password, $profile->password)) {
			$profile->name = $request->name;
			$profile->email = $request->email;
			$profile->mobile_no = $request->mobile_no;

			if($request->new_password)
				$profile->password = bcrypt($request->new_password);
			$profile->save();
			\Session::flash('success', 'Account Information Updated Successfully!');
		}
		else {
			\Session::flash('danger', 'Error Occured While Updating the Account Information!');
		}

		return redirect('/my/account_information');
	}

	public function getOrders()
	{
		$orders = Order::where([
			['status', 1],
			['user_id', Auth::user()->id],
		])->paginate(4);

		return view('users.profile_settings.orders.index', compact('orders'));
	}

	public function viewOrder($id) {
		$order = Order::find($id);
		if($order)
		{
			if($order->user_id == Auth::user()->id)
				return view('users.profile_settings.orders.view', compact('order'));
			else
				return view('errors.401');
		}
		else
		{
			\Session::flash('danger', 'No order found having id');
			return redirect('/my/orders');
		}
	}

	public function getShippings() {
		$shippings = Shipping::where([
			['status', 1],
			['user_id', Auth::user()->id],
		])->paginate(6);

		return view('users.profile_settings.address_book.index', compact('shippings'));
	}

	public function createShipping() {
		$states = require_once(base_path().'/resources/views/libraries/states.php');
		return view('users.profile_settings.address_book.create', compact('states'));
	}

	public function storeShipping(Request $request)
	{
		$this->validate($request, [
			'address' => 'required',
			'city' => 'required',
			'state' => 'required',
			'pincode' => 'required|digits:6',
		]);

		$shipping = Shipping::create([
			'user_id' => Auth::user()->id,
			'address' => request('address'),
			'city' => request('city'),
			'state' => request('state'),
			'pincode' => request('pincode'),
			'created_by' => Auth::user()->id,
			'updated_by' => Auth::user()->id,
		]);

		if($request->landmark) {
			$shipping->landmark = $request->landmark;
			$shipping->save();
		}
		\Session::flash('success', 'Address added to your address book!');

		$url = explode('/', url()->previous());
		$url_part = end($url);

		if($url_part === 'checkout') {
			return redirect(url()->previous());
		}
		else {
			return redirect('/my/address_book');
		}
	}

	public function editShipping($id) {
		$shipping = Shipping::find($id);
		if($shipping) {
			if($shipping->user_id == Auth::user()->id) {
				$states = require_once(base_path().'/resources/views/libraries/states.php');
				return view('users.profile_settings.address_book.edit', compact('shipping', 'states'));
			}
			else {
				return view('errors.404');
			}
		}
		else {
			\Session::flash('danger', 'No shipping found having the id: '.$id);
			return redirect('/my/address_book');
		}
	}

	public function updateShipping(Request $request, $id) {
		$shipping = Shipping::find($id);
		if($shipping) {
			if($shipping->user_id == Auth::user()->id) {
				$this->validate($request, [
					'address' => 'required',
					'city' => 'required',
					'state' => 'required',
					'pincode' => 'required|digits:6',
				]);

				$shipping->address = $request->address;
				$shipping->city = $request->city;
				$shipping->state = $request->state;
				$shipping->pincode = $request->pincode;
				$shipping->updated_by = Auth::user()->id;
				if($request->landmark)
					$shipping->landmark = $request->landmark;
				$shipping->save();

				\Session::flash('success', 'Address updated successfully!');
			}
			else {
				return view('errors.404');
			}
		}
		else {
			\Session::flash('danger', 'No shipping found having the id: '.$id);
		}
		return redirect('/my/address_book');
	}

	public function deleteShipping(Request $request, $id) {
		$shipping = Shipping::find($id);
		if($shipping) {
			if($shipping->user_id == Auth::user()->id) {
				$shipping->status = 0;
				$shipping->updated_by = Auth::user()->id;
				$shipping->save();

				\Session::flash('warning', 'Address deleted successfully');
			}
			else {
				return view('errors.404');
			}
		}
		else {
			\Session::flash('danger', 'No shipping found having the id: '.$id);
		}
		return redirect('/my/address_book');
	}

	public function getReviews() {
		$orders_without_rating = Order::doesntHave('rating')->latest()->take(3)->get();
		$orders_with_rating = Order::has('rating')->paginate(2);
		return view('users.profile_settings.reviews.index', compact('orders_without_rating', 'orders_with_rating'));
	}

	public function createReview($id) {
		$rating = Rating::where([
				['order_id', $id],
			])->get();
		if(count($rating) == 0) {
			$order = Order::find($id);
			if($order){
				if($order->user_id == Auth::user()->id)
					return view('users.profile_settings.reviews.create', compact('order'));
				else {
					return view('errors.404');
				}
			}
			else {
				\Session::flash('danger', 'Order Not found!');
			}
		}
		else{
			\Session::flash('Order Already Reviewed!');
		}
		return redirect('/my/reviews');
	}

	public function storeReview(Request $request) {
		$order = Order::find($request->order);
		if($order->user_id == Auth::user()->id) {
			$this->validate($request, [
				'order' => 'required|digits:1',
				'rating' => 'required|digits:1|min:1|max:5',
			]);
			try {
				$rating = Rating::create([
					'order_id' => $request->order,
					'rating' => $request->rating,
					'created_by' => Auth::user()->id,
					'updated_by' => Auth::user()->id,
				]);

				if($request->feedback) {
					$rating->feedback = $request->feedback;
					$rating->save();
				}
				\Session::flash('success', 'Review Submitted!');
			}
			catch(\PDOException $e)
			{
				\Session::flash('danger', $e->errorInfo[2].': Review already exist!');
			}
		}
		else {
			return view('errors/401');
		}
		return redirect('/my/reviews');
	}

	public function editReview($id) {
		$rating = Rating::find($id);
		if($rating) {
			if($rating->order->user_id == Auth::user()->id) {
				return view('users.profile_settings.reviews.edit', compact('rating'));
			}
			else {
				return view('errors.404');
			}
		}
		else {
			\Session::flash('danger', 'No user rating found!');
			return redirect('/my/reviews');
		}
	}

	public function updateReview(Request $request, $id) {
		$rating = Rating::find($id);
		if($rating) {
			if($rating->order->user_id == Auth::user()->id) {
				$this->validate($request, [
					'rating' => 'required|digits:1|min:1|max:5',
				]);

				$rating->rating = $request->rating;
				$rating->updated_by = Auth::user()->id;
				if($request->feedback) {
					$rating->feedback = $request->feedback;
				}
				$rating->save();
				\Session::flash('success', 'Review Updated Successfully!');
			}
			else {
				return view('errors.404');
			}
		}
		else {
			\Session::flash('danger', 'No user rating found!');
			return redirect('/my/reviews');
		}
		return redirect('my/reviews');
	}

	public function deletereview($id) {
		$rating = Rating::find($id);
		if($rating) {
			if($rating->order->user_id == Auth::user()->id) {
				$rating->forceDelete();
			}
			else {
				return view('errors.404');
			}
		}
		else {
			\Session::flash('danger', 'No user rating found!');
			return redirect('/my/reviews');
		}
		return redirect('/my/reviews');
	}

	public function getUnreviewed() {
		$orders = Order::doesntHave('rating')->latest()->paginate(6);
		return view('users.profile_settings.reviews.unreviewed', compact('orders'));
	}
}
