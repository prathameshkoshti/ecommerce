@extends('users.layouts.nav_bar')

@if($category)
	@section('title', 'Products :: '.$category)
@elseif($search_query)
	@section('title', 'Products Search :: '.$search_query)
@endif

@section('body-content')
<br><br><br>
<br><br><br>
<div class="row">
	<div class="col-md-12">
		<div class="product-cat-heading">
			<span class="header">
				{{$category != '' ? $category : $search_query}}
			</span>
		</div>
	</div>
	<div class="col-md-12">
		<br>
		<br>
		<div class="products-index-grid">
			@foreach($products as $product)
				<div class="product">
					@php
						$images = explode(',', $product->image_names);
					@endphp
					<a href="/product/view/{{$product->id}}">
						<img width="250px" height="250px" src="{{asset('storage/'.$product->category->name.'/'.$images[0])}}" alt="">
					</a>
					<span class="product-name">
						<a href="/product/view/{{$product->id}}">
							{{$product->name}}
						</a>
					</span>
					<span class="wishlist" style="color: #ffa900">
						@php
							$flag = 0;
							if(Auth::check())
							foreach($wishlist as $item)
							{
								if($product->id == $item)
								{
									$flag = $item;
									break;
								}
							}
						@endphp
						@if($flag > 0)
							<a href="/my/wishlist/remove_item/{{$flag}}" style="color: #ffa900">
								<i class="fas fa-heart fa-lg"></i>
							</a>
						@else
							<a href="/my/wishlist/add_item/{{$product->id}}" style="color: #ffa900">
								<i class="far fa-heart fa-lg"></i>
							</a>
						@endif
					</span>
					<span class="product-category">
						{{$product->material->name}}
					</span>
					<span class="product-price">
						$ {{$product->price}}
					</span>
				</div>
			@endforeach
		</div>
	</div>
</div>
<br><br><br>
<br><br><br>
@include('users.layouts.footer')
@stop