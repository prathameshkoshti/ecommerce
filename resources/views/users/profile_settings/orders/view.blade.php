@extends('users.layouts.account_layout')
@section('title', 'My Orders')

@section('heading', 'My Orders')
@section('menu_container')
<style>
	.order-container {
		display: grid;
		grid-template-columns: 1fr 2fr;
		grid-gap: 20px
	}
	p{
		font-size: 0.9em;
	}
</style>
<div class="container">
	<div class="col-md-12 menu-container">
		<h4>
			Viewing Order
		</h4>
		<hr>
		<div class="order-container">
			@php
				$images = explode(',', $order->quantity->product->image_names);
			@endphp
			<img width="200px" height="200px" src="{{asset('storage/'.$order->quantity->product->category->name.'/'.$images[0])}}" alt="">
			<div class="order-info">
				<p>
					<b>{{$order->quantity->product->name}}</b><br><br>
					Category: <em>{{$order->quantity->product->category->name}}</em><br>
					Material: <em>{{$order->quantity->product->material->name}}</em><br><br>
					Qty: {{$order->ordered_quantity}}<br>
					Price: <b>$ {{$order->price}}</b><br><br>
					Order Date: {{$order->order_date}}<br>
					Delivery Status:
					@if($order->delivery_status == 0)
						Confirmed
					@elseif($order->delivery_status == 1)
						Dispatched
					@elseif($order->delivery_status == 2)
						Delivered
					@else
						Cancelled
					@endif
					<br>
					@if($order->delivery_status == 3)
						Cancellation Reason: <br>
						<p>
							{{$order->cancellation_reason}}
						</p>
					@endif
					<br>
					Order Status Updated On: {{$order->action_date}}
					<br><br>
					Shipping information:<br>
					{{($order->shipping->address)}}<br>
					@if($order->shipping->landmar)
					{{($order->shipping->landmark)}}<br>
					@endif
					{{($order->shipping->city)}}<br>
					{{($order->shipping->state)}}<br>
					{{($order->shipping->pincode)}}<br><br>
					Phone No.: {{Auth::user()->mobile_no}}
				</p>
			</div>
		</div>
	</div>
</div>
@stop
