@extends('users.layouts.account_layout')
@section('title', 'My Orders')

@section('heading', 'My Orders')
@section('menu_container')
<style>
	.menu-container {
		display: grid;
		grid-template-columns: 1fr;
		grid-gap: 30px;
	}
	.order-container {
		display: grid;
		grid-template-columns: 1fr;
		grid-gap: 20px;
	}
	.order {
		display: grid;
		grid-template-columns: 1fr 5fr 1fr;
		grid-gap: 30px;
	}
	.order-info{
		font-size: 0.9em;
	}
	.price {
		color: #FFA900;
		font-weight: 600
	}
	.pagination-wrapper {
		text-align: center;
	}
	.paginate {
		display: inline-block;
	}
	a{
		color: #000;
	}
	a:hover {
		color: #FFA900;
	}
	.order img {
		margin-left: 50px;
	}
</style>
<div class="container">
	@if($orders->isEmpty())
	<div class="col-md-12 alert alert-warning">
		<p class="font-weight-bold flash label label-warning"><h5>No orders placed so far.</h5></p>
	</div>
	@endif
	@if(count($orders))
	<div class="col-md-12 menu-container">
		<h4>
			Orders
		</h4>
		<div class="order-container">
			@foreach($orders as $order)
			<a href="/my/orders/view/{{$order->id}}">
				<div class="order">
					@php
						$images = explode(',', $order->quantity->product->image_names);
					@endphp
					<img width="150px" height="150px" src="{{asset('storage/'.$order->quantity->product->category->name.'/'.$images[0])}}" alt="">
					<div class="order-info">
						<p>
							<b>{{$order->quantity->product->name}}</b><br><br>
							Qty: {{$order->ordered_quantity}}<br>
							Size: {{$order->quantity->size->name}}<br><br>
							Date of Order: {{$order->order_date}}<br>
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
						</p>
					</div>
					<div class="price">
						$ {{$order->price}}
					</div>
				</div>
			</a>
			<div class="hr">
				<hr>
			</div>
			@endforeach
		</div>
		<div class="pagination-wrapper">
			<div class="paginate">
				{{$orders->render()}}
			</div>
		</div>
	</div>
	@endif
</div>

@stop