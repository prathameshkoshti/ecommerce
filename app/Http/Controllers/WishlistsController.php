<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Wishlist;
use Auth;

class WishlistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$users = User::where('isAdmin', 0)->get();
		return view('admin.wishlists.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wishlist = Wishlist::where([
			['user_id', $id],
			['status', 1]
		])->get();
		$user = User::find($id);
		if($wishlist)
			return view('admin.wishlists.view', compact('wishlist', 'user'));
		else
		{
			\Session::flash('danger', 'No wishlist found for user: '.$user->name);
			return redirect('/admin/wishlists');
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
		$wishlist = Wishlist::find($id);
		if(!$wishlist)
		{
			\Session::flash('danger', 'No wishlist found having id: '.$id);
			return redirect('/admin/wishlists');
		}

		$wishlist->status = 0;
		$wishlist->updated_by = Auth::user()->id;

		$wishlist->save();

		\Session::flash('warning', 'Product: '. $wishlist->product->name.' from '.$wishlist->user->name.'\'s wishlist successfully!');
		return redirect('/admin/wishlists/view/'.$wishlist->user_id);
    }
}
