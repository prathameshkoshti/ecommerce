@extends('users.layouts.account_layout')
@section('title', 'My Reviews')

@section('heading', 'My Reviews')
@section('menu_container')
<style>
	.pagination-wrapper {
		text-align: center;
	}
	.paginate {
		display: inline-block;
	}
	.unreviewed-products-container {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		grid-gap: 20px;
		margin-top: 30px;
	}
	.product-info {
		color: #FFA900;
		font-weight: 600;
		font-size: 0.9em;
	}
	.link {
		color: #000;
		float: right;
		position: relative;
		right: -70px;
	}
	.product-category {
		color: #212121;
		font-size: 0.8em;
	}
	.order {
		display: grid;
		grid-template-columns: 1fr;
		text-align: center;
		background: #fff;
		text-align: center;
	}
	.more-link {
		grid-column-start: 3;
		margin-left: 50%;
		margin-top: 100%;
	}
	.reviewed-products-container {
		display: grid;
		grid-template-columns: 1fr;
		grid-gap: 20px;
		margin-top: 30px;
	}
	.reviewed-order {
		display: grid;
		grid-template-columns: 200px 1fr;
		background: #fff;
		padding: 20px;
	}
	.button {
		border: none;
		outline: none;
		border: 2px solid;
		padding: 5px 10px;
		width: 20%;
		transition: 0.4s ease-in-out
	}
	.edit-btn {
		color: #FFA900;
		border-color: #FFA900;
	}
	.edit-btn:hover {
		background: #FFA900;
		color: #fff;
		cursor: pointer;
	}
	.delete-btn {
		color: #EF5350;
		border-color: #EF5350;
	}
	.delete-btn:hover {
		background: #EF5350;
		color: #fff;
		cursor: pointer;
	}
	.fa-star {
		color: #FFA900;
	}
	@media only screen and (max-width:1080px) {
		.unreviewed-products-container {
			grid-template-columns: 1fr 1fr;
		}
		.link {
			margin-right: 30px;
		}
		.button {
			width:40%;
		}
	}
</style>
<div class="container">
	@include('users.layouts.resources')
	<div class="col-md-12 menu-container">
		<h4>
			<u><a href="/my/reviews/unreviewed" style="color: #212121">Products (Yet to be Rated)</a></u>
		</h4>
		<div class="unreviewed-products-container">
			@foreach($orders_without_rating as $order)
			<div class="order">
				<a href="/product/view/{{$order->quantity->product->id}}">
					@php
						$images = explode(',', $order->quantity->product->image_names);
					@endphp
					<div>
						<img src="{{asset('storage/'.$order->quantity->product->category->name.'/'.$images[0])}}" width="150px" height="150px" alt="">
					</div>
					<br>
					<div class="product-info">
						<div class="product-name">{{$order->quantity->product->name}}</div>
						<div class="product-category">{{$order->quantity->product->category->name}}</div>
					</div>
				</a>
				<div class="hr">
					<hr>
				</div>
				<a href="/my/reviews/create/{{$order->id}}" class="link">
					<u>Review Product</u>
				</a><br>
			</div>
			@endforeach
		</div>
		<br>
		<hr>
		<br>
		<h4>
			Rated Products
		</h4>
		<div class="reviewed-products-container">
			@foreach($orders_with_rating as $order)
			<div class="reviewed-order">
				@php
					$images = explode(',', $order->quantity->product->image_names);
				@endphp
				<div>
					<img src="{{asset('storage/'.$order->quantity->product->category->name.'/'.$images[0])}}" width="150px" height="150px" alt="">
				</div>
				<div class="product-review">
					<p>
						<div class="product-name">{{$order->quantity->product->name}}</div>
						<div class="product-category">{{$order->quantity->product->category->name}}</div>
						<div class="quantity">{{$order->ordered_quantity}}</div>
						<div class="price">$ {{$order->price}}</div><br>
						<div class="rating">
							Rating Given By You:<br>
							@for($i = 1; $i <= $order->rating->rating; $i++)
								<i class="fas fa-star fa-2x"></i>
								@if($i == 5)
									@break
								@endif
							@endfor

						</div>
						<br>
						Feedback:<br>
						<p>
						@if($order->rating->feedback === NULL)
							<b>No Feedback.</b>
						@else
							<b>{{$order->rating->feedback}}</b>
						@endif
						</p>
					</p>
					<p>
						<button class="button edit-btn" onclick="location.href='/my/reviews/edit/{{$order->rating->id}}'"><i class="fas fa-pencil-alt fa-1x"></i> Edit</button>
						<button class="button delete-btn" onclick="location.href='/my/reviews/delete/{{$order->rating->id}}'"><i class="fas fa-trash"></i> Delete</button>
					</p>
				</div>
			</div>
			<div class="hr">
				<hr>
			</div>
			@endforeach
			<div class="pagination-wrapper">
				<div class="paginate">
					{{$orders_with_rating->render()}}
				</div>
			</div>
			<br>
		</div>
	</div>
</div>
@stop