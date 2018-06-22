@extends('users.layouts.nav_bar')

@section('title', 'Undandy :: Checkout')

@section('body-content')
<style>
	.address-container{
		display: grid;
		grid-template-columns: 1fr 1fr 1fr;
		grid-gap: 20px;
	}
	.button {
		border: 2px solid #212121;
		background: #fff;
		transition: 0.6s ease;
		padding: 5px;
		color: #212121;
	}
	.button:hover {
		cursor: pointer;
		color: #ffa900;
		border-color: #ffa900;
		transition: 0.6s ease;
	}
	p{
		font-family:Verdana, Geneva, Tahoma, sans-serif
	}
	.address{
		display: grid;
		grid-template-columns: 0.2fr 1fr;
	}
	input{
		margin-top: 5px;
	}
	label{
		border-radius: 5px;
		border: 1px solid #E1E1E1;
		padding-left: 20px;
		padding-top: 10px;
		padding-bottom: 10px
	}
	.order-summary{
		background: #F1F1F1;
		padding: 5%;
		height: auto;
	}
	.header{
		margin-left: 0%;
		border-bottom: 0px;
	}
	.cart-items{
		display: grid;
		grid-template-columns: 1fr;
		grid-row-gap: 20px;
	}
	.cart-item{
		display: grid;
		grid-template-columns: 1fr 8fr 1fr;
		grid-gap: 10px;
	}
	.price {
		font-weight: 600;
		font-size: 0.8em
	}
	.product-info{
		font-size: 0.7em;
	}
	.submit{
		border-radius: 0px;
		color:#ffa900;
		border-color: #ffa900;
		transition: 0.6s ease;
	}
	.submit:hover{
		color:#fff;
		background: #ffa900;
		transition: 0.6s ease;
	}
	input:checked + label{
		color: #ffa900;
		border: 1px solid #ffa900;
		transition: 0.3s ease-in-out;
	}
	#create-address {
		float: right;
	}
	#create-address-form{
		display: none;
		position: fixed;
		z-index: 99999999;
		border: 1px solid #E1E1E1;
		height: auto;
		background: #FFFFFF;
		padding: 5%;
		box-shadow: 0px 0px 30px 5px rgba(0, 0, 0, 0.15);
	}
	input[type=button] {
		border: 2px solid #212121;
		border-radius: 0px;
		transition: 0.3s ease-in-out;
	}
	input[type=button]:hover {
		background: #212121;
		cursor: pointer;
		color: #fff;
		transition: 0.3s ease-in-out;
	}
	input[type=submit] {
		color:#ffa900;
		border-radius: 0px;
		transition: 0.3s ease-in-out;
		border: 2px solid #ffa900;
	}
	input[type=submit]:hover {
		cursor: pointer;
		transition: 0.3s ease-in-out;
		color: #fff;
		background: #ffa900
	}
	sup{
		color: #FF5722;
		font-size: 1em;
	}
	@media only screen and (max-width: 1080px)
	{
		.address-container{
			grid-template-columns: 1fr 1fr;
		}
	}
</style>
<br><br><br><br>
<div class="row">
	<div class="col-md-12">
		<h3 class="header">
			Shipping Address
		</h3>
	</div>
</div>
<form style="{{count($shippings) > 0  ? '' : 'display: block'}}" action="my/shipping_addresses/store" class="col-md-8 offset-md-1" method="POST" id="create-address-form">
	<div class="">
		<h4>
			New Shipping Address
		</h4>
	</div>
	<br>
	<table class="table table-borderless">
		<tr>
			<td>
				Address <sup>*</sup>
			</td>
			<td colspan="2">
				<input type="text" name="address" id="" class="form-control" required>
			</td>
		</tr>
		<tr>
			<td>
				Landmark
			</td>
			<td colspan="2">
				<input type="text" name="landmark" class="form-control" id="">
			</td>
		</tr>
		<tr>
			<td>
				City <sup>*</sup>
			</td>
			<td colspan="2">
				<input type="text" name="city" class="form-control" id="" required>
			</td>
		</tr>
		<tr>
			<td>
				State <sup>*</sup>
			</td>
			<td colspan="2">
				<select name="state" id="" required class="form-control">
					<option value="NULL" disabled selected>Select State</option>
					@foreach($states as $state)
						<option value="{{$state}}">{{$state}}</option>
					@endforeach
				</select>
			</td>
		</tr>
		<tr>
			<td>
				Pincode <sup>*</sup>
			</td>
			<td colspan="2">
				<input type="tel" name="pincode" max="6" class="form-control" required>
			</td>
		</tr>
		<tr>
			<td colspan="3"></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" value="Submit" class="form-control" class="button">
			</td>
			<td>
				<input type="button" class="form-control" class="button" value="Cancel" onclick="document.getElementById('create-address-form').style.display='none'">
			</td>
		</tr>
	</table>
	@csrf
	@method('PUT')
</form>
<form method="POST" action="/checkout/place_order" id="place-order">
	<div class="row">
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12">
					<hr>
					@include('users.layouts.resources')
				</div>
				<div class="col-md-12">
					<div class="address-container">
						@foreach($shippings as $shipping)
						<div class="address">
							{{-- <p> --}}
								<input type="radio" name="shipping" id="radio{{$shipping->id}}" value="{{$shipping->id}}">
							{{-- </p> --}}
							<label for="radio{{$shipping->id}}" class="address-content">
								<p>
									{{$shipping->address}}<br>
									@if($shipping->landmark)
									{{$shipping->landmark}}
									<br>
									@endif
									<br>
									{{$shipping->city}}<br>
									{{$shipping->state}}<br><br>
									{{$shipping->pincode}}
								</p>
							</label>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<br>
						<div class="button" id="create-address">
							<i class="fas fa-plus-circle"></i> Create new Address
						</div>
					<br>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="order-summary">
				<div class="col-md-12">
					<h3 class="header">
						ORDER SUMMARY
					</h3>
				</div>
				<div class="col-md-12">
					<b>{{count($cart)}} Items in Cart </b>
				</div>
				<div class="col-md-12 cart-items">
					<div class="hr">
						<hr>
					</div>
					@foreach($cart as $cart_item)
					<div class="cart-item">
						@php
							$images = explode(',', $cart_item->quantity->product->image_names)
						@endphp
						<div>
							<img src="{{url('storage/'.$cart_item->quantity->product->category->name.'/'.$images[0])}}" width="80px" height="80px">
						</div>
						<div class="product-info">
							<p class="product-name">
								{{$cart_item->quantity->product->name}}
							</p>
							<p style="font-size: 1.1em">
								Qty: {{$cart_item->ordered_quantity}}<br>
								Size: {{$cart_item->quantity->size->name}}
							</p>
						</div>
						<div>
							<p class="price">${{$cart_item->ordered_quantity * $cart_item->quantity->product->price}}</p>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			<br>
			<div>
				<input type="submit" value="PLACE ORDER" class="button submit form-control">
			</div>
		</div>
	</div>
	@method('PUT')
	@csrf
</form>
<script>
	document.getElementById('place-order').onsubmit = function() {
		validate();
	};

	function validate() {
		var radios = document.getElementsByName("shipping");
		var formValid = false;

		var i = 0;
		while(!formValid && i < radios.length) {
			if(radios[i].checked){
				formValid = true;
				var val = radios[i].value;
			}
			i++;
		}
		if(!formValid) {
			console.log(val);
			alert('Please select your shipping address');
		}
	}

	$(document).ready(function() {
		$('#create-address').click(function() {
			$('#create-address-form').toggle();
		});
	});
</script>
@stop