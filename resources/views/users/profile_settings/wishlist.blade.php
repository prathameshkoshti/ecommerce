@extends('users.layouts.account_layout')
@section('title', 'My Orders')

@section('heading', 'My Wishlist')
@section('menu_container')
<style>
	.wishlist-container {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		grid-gap: 20px;
	}
	.wishlist {
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
	.remove-link {
		color: #000;
		float: right;
		position: relative;
		right: -70px;
	}
	.product-category {
		color: #212121;
		font-size: 0.8em;
	}
	@media only screen and (max-width: 1080px) {
		.wishlist-container {
			grid-template-columns: repeat(2, 1fr);
		}
	}
</style>
<div class="container">
	@if($wishlist)
	<div class="col-md-12 menu-container">
		<h4>
			Wishlist
		</h4>
		<hr>
		<div class="wishlist-container">
			@foreach($wishlist as $wishlist_item)
			<div class="wishlist">
				<a href="/product/view/{{$wishlist_item->product->id}}">
					@php
						$images = explode(',', $wishlist_item->product->image_names);
					@endphp
					<div>
						<img src="{{asset('storage/'.$wishlist_item->product->category->name.'/'.$images[0])}}" width="200px" height="200px" alt="">
					</div>
					<br>
					<div class="product-info">
						<div class="product-name">{{$wishlist_item->product->name}}</div>
						<div class="product-category">{{$wishlist_item->product->category->name}}</div>
					</div>
				</a>
				<div class="hr">
					<hr>
				</div>
				<a href="/my/wishlist/remove_item/{{$wishlist_item->id}}" class="remove-link">
					<u>Remove</u>
				</a><br>
			</div>
			@endforeach
		</div>
		<hr>
		<div class="pagination-wrapper">
			<div class="paginate">
				{{$wishlist->render()}}
			</div>
		</div>
	</div>
	@else
	<div class="col-md-12 alert alert-warning">
		<p class="font-weight-bold flash label label-warning"><h6>You have placed no orders.</h6></p>
	</div>
	@endif
</div>
@stop