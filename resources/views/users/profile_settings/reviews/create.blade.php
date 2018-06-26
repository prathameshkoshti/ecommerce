@extends('users.layouts.account_layout')
@section('title', 'New Review')

@section('heading', 'My Reviews')
@section('menu_container')
<style>
	.new-review-form {
		margin-top: 30px;
		display: grid;
		grid-template-columns: 1fr;
		grid-gap:20px;
	}
	.input {
		display: grid;
		grid-template-columns: 100px 1fr;

	}
	/* Rating Star Widgets Style */
	.rating-stars ul {
		list-style-type:none;
		padding:0;

		-moz-user-select:none;
		-webkit-user-select:none;
	}
	.rating-stars ul > li.star {
		display:inline-block;
	}

	/* Idle State of the stars */
	.rating-stars ul > li.star > svg {
		font-size:2.5em; /* Change the size of the stars */
		color: #ccc; /* Color on idle state */
	}

	/* Hover state of the stars */
	.rating-stars ul > li.star.hover > svg {
		color:#FFCC36;
	}

	/* Selected state of the stars */
	.rating-stars ul > li.star.selected > svg {
		color:#FF9A00;
	}

	.order {
		display: grid;
		grid-template-columns: 300px 1fr;
		background: #fff;
		padding: 20px;
	}

	.order-container {
		display: grid;
		grid-template-columns: 1fr;
		grid-gap: 20px;
		margin-top: 30px;
	}
	.product-name {
		color: #FF9A00;
		font-weight: bold;
		font-size: 1.2em;
	}
	.product-category {
		color: #212121;
		font-size: 0.8em;
	}
	.button {
		border: none;
		outline: none;
		border: 2px solid;
		padding: 5px 10px;
		width: 20%;
		transition: 0.4s ease-in-out;
		color: #FFA900;
		border-color: #FFA900;
	}
	.button:hover {
		background: #FFA900;
		color: #fff;
		cursor: pointer;
	}
</style>
<div class="container">
	<div class="col-md-12 menu-container">
		<h4>
			Create Review for Product:
		</h4>
		<div class="order-container">
			<div class="order">
					@php
					$images = explode(',', $order->quantity->product->image_names);
				@endphp
				<div>
					<img src="{{asset('storage/'.$order->quantity->product->category->name.'/'.$images[0])}}" width="200px" height="200px" alt="">
				</div>
				<div class="product-review">
					<p>
						<div class="product-name">{{$order->quantity->product->name}}</div>
						<div class="product-category">{{$order->quantity->product->category->name}}</div>
						<div class="quantity">Qty: {{$order->ordered_quantity}}</div>
						<div class="price">$ {{$order->price}}</div><br>
						<div class="delivery-status">Delivery Status:
						@if($order->delivery_status == 0)
							Confirmed
						@elseif($order->delivery_status == 1)
							Dispatched
						@elseif($order->delivery_status == 2)
							Delivered
						@else
							Cancelled
						@endif
						</div><br>
					</p>
				</div>
			</div>
		</div>
		<br><br><br>
		<h4>Please give a rating to your product:</h4>
		@include('users.layouts.resources')
		<form action="/my/reviews/store" class="new-review-form" method="POST">
			<div class="input">
				<label for="rating">Rating</label>
				<div class='rating-stars'>
					<ul id='stars'>
						<li class='star' title='Poor' data-value='1'>
						<i class='fa fa-star fa-fw'></i>
						</li>
						<li class='star' title='Fair' data-value='2'>
						<i class='fa fa-star fa-fw'></i>
						</li>
						<li class='star' title='Good' data-value='3'>
						<i class='fa fa-star fa-fw'></i>
						</li>
						<li class='star' title='Excellent' data-value='4'>
						<i class='fa fa-star fa-fw'></i>
						</li>
						<li class='star' title='WOW!!!' data-value='5'>
						<i class='fa fa-star fa-fw'></i>
						</li>
					</ul>
					<input type="hidden" name="rating" id="rating" value="0" required>
					<input type="hidden" name="order" id="order" value="{{$order->id}}" required>
				</div>
			</div>
			<div class="input">
				<label for="feedback">Feedback:</label>
				<textarea name="feedback" id="feedback" class="form-control" cols="20" rows="5"></textarea>
			</div>
			<div class="input">
				<p></p>
				<p>
					<input type="submit" value="Rate It!" class="button" id="submit">
				</p>
			</div>
			@csrf
			@method('PUT')
		</form>
	</div>
</div>
<script>
	$('#stars li').on('mouseover', function(){
    	var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

		// Now highlight all the stars that's not after the current hovered star
		$(this).parent().children('li.star').each(function(e){
			if (e < onStar) {
				$(this).addClass('hover');
			}
			else {
				$(this).removeClass('hover');
			}
		});
	}).on('mouseout', function(){
		$(this).parent().children('li.star').each(function(e){
			$(this).removeClass('hover');
		});
  	});
	$('#stars li').on('click', function(){
		var onStar = parseInt($(this).data('value'), 10); // The star currently selected
		var stars = $(this).parent().children('li.star');

		for (i = 0; i < stars.length; i++) {
			$(stars[i]).removeClass('selected');
		}

		for (i = 0; i < onStar; i++) {
			$(stars[i]).addClass('selected');
		}

		var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
		$('#rating').val(ratingValue);
	});

	$('#submit').on('click', function() {
		if($('#rating').val() == 0) {
			alert('Please provide sufficient rating!');
			return false;
		}
	});
</script>
@stop