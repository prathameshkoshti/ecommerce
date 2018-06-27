@extends('users.layouts.nav_bar')

@section('title', 'Undandy :: Cart')

@section('body-content')
<style>
.cart-container{
	margin-top: 10%;
}
.cart{
	display: grid;
	margin-top: 20px;
}
.cart-item{
	display: flex;
	flex-direction: row;
	height: auto;
}
.cart-item > img{
	flex: 1;
}
.cart-item > .cart-item-info{
	flex: 5;
}
.product-name{
	font-size: 1em;
	font-weight: 700;
	letter-spacing: 1pt;
	text-transform: uppercase;
}
.shoe-size{
	margin-top: 4%;
	font-size: 0.8em;
}
.price{
	float: right;
	color: #ffa900;
	font-size: 1.4em;
}
.price:before{
	content: '$';
}
.quantity{
	margin-top: 4%;
	font-size: 0.9em;
}
.quantity input[type="number"]{
	width: 50px;
}
.button{
	border: none;
	color: #fff;
	padding: 5px 5px;
	font-size: 0.9em;
}
.update-button{
	color: #ffa900;
	background: #fff;
}
.button:hover{
	cursor: pointer;
}
.button-group{
	display: grid;
	grid-template-columns: 1.2fr 1fr;
	grid-column-gap: 40px;
}
.remove-button{
	background: #fff;
	color: #EF5350;
	border: 2px solid #EF5350;
	transition: 0.2s ease-in;
}
.purchase-button{
	background: #fff;
	color: #ffa900;
	border: 2px solid #ffa900;
	transition: 0.2s ease-in;
	width: 100%;
	padding: 10px 10px;
	margin-top: 10%;
	font-weight: 600;
}
.table{
	font-size: 0.8em;
}
.purchase-button:hover{
	background: #ffa900;
	color: #fff;
	transition: 0.2s ease-in;
}
.move-button{
	background: #fff;
	color: #616161;
	border: 2px solid #616161;
	transition: 0.2s ease-in;
}
.move-button:hover{
	background: #616161;
	color: #fff;
	transition: 0.2s ease-in;
}
.remove-button:hover{
	background: #EF5350;
	color: #fff;
	transition: 0.2s ease-in;
}
.invoice-container{
	background: #F1F1F1;
	color: #414141;
	height:auto;
	padding: 2% 4%;
}
.summary-header{
	font-family: 'Valencia';
	text-transform: uppercase;
	font-size: 2em;
	margin-bottom: 5%;
}
@media only screen and (max-width: 720px) {
	.product-cat-heading:before {
		margin-left: -10px;
	}
}
</style>
<div class="cart-container">
	<div class="col-md-12">
		<div class="product-cat-heading">
			<span class="header">
				SHOPPING BAG
			</span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 cart">
		@include('users.layouts.resources')

		@foreach($cart as $cart_item)
			<div class="cart-item">
				@php
				$images = explode(',', $cart_item->quantity->product->image_names);
				@endphp
				<img src="{{asset('storage/'.$cart_item->quantity->product->category->name.'/'.$images[0])}}" alt="{{$images[0]}}" wisth="200px" height="200px">
				<div class="cart-item-info">
					<div class="product-name">
					{{$cart_item->quantity->product->name}}
					</div>
					<div class="shoe-size">
					<b>Shoe Size:</b> {{$cart_item->quantity->size->name}}
					<span class="price">
						{{$cart_item->quantity->product->price * $cart_item->ordered_quantity}}
					</span>
					</div>
					<div class="quantity">
						<form action="cart/update_quantity/{{$cart_item->id}}" method="post">
							<label for="quantity">Quantity: </label>
							<input type="number" value="{{$cart_item->ordered_quantity}}" min="1" max="{{$cart_item->quantity->quantity}}" name="quantity" id="quantity">
							<input type="submit" value="UPDATE" class="button update-button">
							@method('PUT')
							@csrf
						</form>
					</div>
					<br>
					<div class="button-group">
						<button class="button move-button"  onclick="location.href='cart/move_to_wishlist/{{$cart_item->id}}'">
							MOVE TO WISHLIST
						</button>
						<button class="button remove-button" onclick="location.href='cart/remove_item/{{$cart_item->id}}'">
							REMOVE
						</button>
					</div>
				</div>
			</div>
			<div class="hr">
				<hr>
			</div>
		@endforeach
		</div>
		<div class="col-md-4 invoice-container">
			<br>
			<div class="summary-header">
				Summary
			</div>
			<br>
			<table class="table table-borderless">
				<tr>
					<td>
						SUBTOTAL
					</td>
					<td align="right">
						@php
							$subtotal = 0;
							foreach($cart as $cart_item)
							{
								$subtotal += $cart_item->ordered_quantity * $cart_item->quantity->product->price;
							}
							echo '$ '.$subtotal;
						@endphp
					</td>
				</tr>
				<tr>
					<td>
						TAX
					</td>
					<td align="right">
						$ {{$tax = $subtotal * 0.18}}
					</td>
				</tr>
				<tr>
					<td class="font-weight-bold">
						ORDER TOTAL INCL. TAX
					</td>
					<td align="right" class="font-weight-bold">
						$ {{$subtotal + $tax}}
					</td>
				</tr>
				<tr>
					<td class="font-weight-bold">
						ORDER TOTAL EXCL. TAX
					</td>
					<td align="right" class="font-weight-bold">
						$ {{$subtotal}}
					</td>
				</tr>
			</table>
			<hr>
			<button onclick="location.href='/checkout'" class="button purchase-button">
				PROCEED TO PURCHASE
			</button>
		</div>
	</div>
</div>
<br><br><br><br><br><br>
@include('users.layouts.footer')
@stop