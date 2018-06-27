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
	.order {
		display: grid;
		grid-template-columns: 1fr;
		text-align: center;
		background: #fff;
		text-align: center;
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
	@media only screen and (max-width:1080px) {
		.unreviewed-products-container {
			grid-template-columns: 1fr 1fr;
		}
		.link {
			margin-right: 30px;
		}
	}
</style>

<div class="container">
	<div class="col-md-12 menu-container">
		<h4>
			Products (Yet to be Rated)
		</h4>

		<div class="unreviewed-products-container">
			@foreach($orders as $order)
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
			<div class="pagination-wrapper">
				<div class="paginate">
					{{$orders->render()}}
				</div>
			</div>
		</div>
	</div>
</div>
@stop