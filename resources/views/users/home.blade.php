@extends('users.layouts.nav_bar')
@section('title', 'Undandy :: Home')
@section('body-content')
	<div class="row banner-container">
		<div class="col-md-12">
			<div class="banner-bg">
				<img class="banner img-fluid" src="{{ url('storage/banner.jpg') }}">
				<div class="banner-content">
					<div class="text">
						<h2>CREATE YOUR LEGACY</h2>
						<br>
						<p>
							Unleash your creative genius by customising shoes as authentic and <br>
							utterly unique as you are
						</p>
						<p>
						<div>
							<button class="banner-btn btn" onclick="location.href='/all'">
								SHOP
							</button>
						</div>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="best-sellers">
				<div class="best-sellers-header">
					BESTSELLERS
				</div>
				<div class="bs-products-container">
					@foreach($products as $product)
						<div class="bs-product">
							<a href="/product/view/{{$product->id}}">
							@php
								$images = explode(',', $product->image_names);
							@endphp
							<div class="product-image">
								<img width="200px" height="200px" src="{{url('storage/'.$product->category->name.'/'.$images[0])}}" alt="">
							</div>
							<br>
							<br>
							<div class="product-info">
								<div class="product-name">
									{{$product->name}}
								</div>
								<div class="product-price">
									$ {{$product->price}}
								</div>
							</div>
							</a>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<br><br>
	<hr>
	<br><br>
	@include('users.layouts.footer')
@stop