@extends('adminlte::page')

@section('title', 'Admin Pamel :: User\'s Wishlist')

@section('content_header')
	<center>
		<h2>{{$user->name}}'s Wishlist</h2>
	</center>
@stop

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="cards-container col-md-10 col-md-offset-1">
			<br>
			<br>
			<div class="row">
				<div class="card-holder">
				@foreach($wishlist as $wishlist_item)
					<div class="card" style="">
						<div class="card-image">
							<div>
							</div>
							@php
							$images = explode(',', $wishlist_item->product->image_names);
							@endphp
							<div>
								<img class="image" width="200px" height="200px" src="{{url('storage/'.$wishlist_item->product->category->name.'/'.$images[0])}}" alt="{{$wishlist_item->product->name}}">
							</div>
						</div>
						<div class="card-info">
							<em class="text-bold">{{$wishlist_item->product->name}}</em><br>
							<span class="text-bold">&#8377 {{$wishlist_item->product->price}}</span><br>
							<button onclick="location.href='/admin/wishlists/delete/{{$wishlist_item->id}}'" class="btn btn-danger"><i class="fa fa-lg fa-trash-o"></i> Remove</button>
						</div>
					</div>
				@endforeach
			</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('css')
@include('admin.layouts.resources')
@include('admin.layouts.wishlist_cards')
@stop