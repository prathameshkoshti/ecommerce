<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rating;

class RatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$ratings = Rating::all();
		return view('admin.ratings.index', compact('ratings'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$rating = Rating::find($id);
		if(!$rating)
		{
			\Session::flash('danger', 'Rating not found having the id: '.$id);
			return redirect('/admin/index');
		}
		return view('admin.ratings.view', compact('rating'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$rating = Rating::find($id);
		if(!$rating)
		{
			\Session::flash('danger', 'Rating not found having the id: '.$id);
			return redirect('/admin/index');
		}

		$rating->status = 0;
		$rating->updated_by = Auth::user()->id;
		$rating->save();

		\Session::flash('warning', 'Rating for order: '.$rating->order->product->name.' delted successfully!');
		return redirect('/admin/index');
    }
}
