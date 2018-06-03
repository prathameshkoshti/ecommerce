<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$orders = Order::all();
		return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
		if(!$order)
		{
			\Session::flash('danger', 'Order not found having the id: '.$id);
			return redirect('/admin/orders');
		}

		return view('admin.orders.view', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
		if(!$order)
		{
			\Session::flash('danger', 'Order not found having the id: '.$id);
			return redirect('/admin/orders');
		}

		return view('admin.orders.edit', compact('order'));
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
		$order = Order::find($id);
		if(!$order)
		{
			\Session::flash('danger', 'Order not found having the id: '.$id);
			return redirect('/admin/orders');
		}

		$this->validate($request, [
			'action_date' => 'required|date',
			'delivery_status' => 'required|numeric',
		]);

		$order->delivery_status = $request->delivery_status;
		if($order->delivery_status == 0)
		{
			$order->cancellation_reason = $request->cancellation_reason;
		}
		$order->action_date = $request->action_date;
		$order->status = $request->status == 'on' ? 1 : 0;

		$order->save();

		\Session::flash('success', 'User: '.$order->user->name.'\'s order id: '.$id.' updated successfully!');
		return redirect('/admin/orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$order = Order::find($id);
		if(!$order)
		{
			\Session::flash('danger', 'Order not found having the id: '.$id);
			return redirect('/admin/orders');
		}

		$order->status = 0;
		$order->updated_by = Auth::user()->id;

		$order->save();

		\Session::flash('warning', 'Order from user:'. $order->user->name.'\'s order list deleted successfully!');
		return redirect('/admin/orders');
    }
}
