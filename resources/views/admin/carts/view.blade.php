@extends('adminlte::page')

@section('title', 'Admin Pamel :: User\'s Carts')

@section('content_header')
	<center>
		<h2>{{$user->name}}'s Cart</h2>
	</center>
@stop

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 col-md-offset-1 cards-holder">
			@php
			$i = 0;
			$n = count($cart);
			@endphp
			<br>
			@foreach($cart as $cart_item)
			<div class="row">
				<div class="col-md-12 card-container">
					<div class="row">
						<div class="card-image col-md-4">
								@php
								$images = explode(',', $cart_item->product->image_names);
							@endphp
							<img class= width="150px" height="150px" src="{{url('storage/'.$cart_item->product->category->name.'/'.$images[0])}}" alt="">
						</div>
						<div class="col-md-6 col-md-offset-1 card-info">
							<p>
								<a href="/admin/products/view/{{$cart_item->product->id}}"><span class="product">{{$cart_item->product->name}}</span><br></a>
								<em class="category">{{$cart_item->product->category->name}}</em>
							</p>
							Size: <span class="size">{{$cart_item->size}}</span><br>
							Quantity: <span class="quantity">{{$cart_item->quantity}}</span>
							Price: <span class="inr">&#8377 {{$cart_item->product->price * $cart_item->quantity}}</span>
							<br>
							<br>
							<div class="delete-item">
								<button class="btn btn-danger" onclick="location.href='/admin/carts/delete/{{$cart_item->id}}'">
									<i class="fa fa-trash fa"></i> Delete
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			@if(++$i != $n)
			<hr>
			@endif
			@endforeach
			<br>
		</div>
		<div class="col-md-4 col-md-offset-1 invoice-container">
			<br>
			<table class="table table-borderless">
				<tr>
					<td>
						Cart Total
					</td>
					<td>
						@php
						$cart_total = 0;
						foreach($cart as $cart_item)
							$cart_total += ($cart_item->quantity * $cart_item->product->price)
						@endphp
						&#8377 {{$cart_total}}
					</td>
				</tr>
					<td>
						Estimated Tax
					</td>
					<td>
						&#8377 {{$tax = round(($cart_total)*(18/100), 2)}}
					</td>
				</tr>
				<tr>
					<td>
						Delivery charges
					</td>
					<td>
						@php
							if($cart_total >= 499)
								$delivery_charges = 0;
							else
								$delivery_charges = 100;
						@endphp
						&#8377 {{$delivery_charges == 0 ? 'Free' : $delivery_charges}}
					</td>
				</tr>
			</table>
			<hr>
			<table class="table table-borderless">
				<tr>
					<td>
						<span class="text-bold">
							Total Cost
						</span>
					</td>
					<td>
						<span class="text-bold">
							&#8377 {{$cart_total + $tax + $delivery_charges}}
						</span>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
@stop

@section('css')
@include('layouts.cart_cards')
@stop