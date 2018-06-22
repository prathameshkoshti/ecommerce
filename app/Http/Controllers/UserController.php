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
use App\Quantity;

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
		])->get();

		dd($wishlist);

		return view('users.wishlist.view');
	}

	public function addToWishlist($product_id)
	{
		$wishlist = Wishlist::where([
			['user_id', Auht::user()->id],
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
		\Session::view('success', 'Item: '.$wishlist->product->name.' addedd to wishlist successfully!');
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
		])->get();

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

	public function placeorder(Request $request)
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
		return redirect('/my/order_placed');
	}

	public function orderPlaced()
	{
		if(\Session::has('order_placed'))
			return view('users.checkout.order_placed');
		return redirect('/');
	}

	/*
		User Settings
	*/
	public function getProfile()
	{
		$profile = Auth::user();
		return view('users.profile.view', compact('profile'));
	}

	public function editProfile()
	{
		$profile = Auth::user();
		return view('users.profile.edit', compact('profile'));
	}

	public function updateProfile(Request $request)
	{
		$profile = Auth::user();
		return redirect('/my/profile');
	}

	public function getOrders()
	{
		$orders = Order::where([
			['status', 1],
			['user_id', Auth::user()->id],
		])->get();

		return view('users.orders.view');
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
			return redirect('/my/shipping_addresses');
		}
	}
}
