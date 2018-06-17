@extends('adminlte::page')

@section('title', 'Admin Panel :: Ratings')

@section('content_header')
	<center>
		<h2>Rating for <em class="text-bold">{{$rating->order->quantity->product->name}}</em> by <em  class="text-bold">{{$rating->order->user->name}}</em></h2>
		<br>
	</center>
@stop

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 cards-holder">
			<div class="row">
				<div class="card-container col-md-12">
					<div class="row">
						<div class="col-md-12 order-details">
							<div class="row">
								<div class="col-md-3">
									<p>
										@php
											$images = explode(',', $rating->order->quantity->product->image_names);
										@endphp
										<img class= width="150px" height="150px" src="{{url('storage/'.$rating->order->quantity->product->category->name.'/'.$images[0])}}" alt="{{ $rating->order->quantity->product->name}}">
									</p>
								</div>
								<div class="col-md-3">
									<p>
										<p>
											<b><a href="/admin/products/view/{{$rating->order->quantity->product->id}}"><span class="product">{{$rating->order->quantity->product->name}}</a></b><br>
											<em class="category">{{$rating->order->quantity->product->category->name}}</em><br>
										</p>
										<p>
											Size: <span class="size">{{$rating->order->quantity->size->name}}</span><br>
											Quantity: <span class="quantity">{{$rating->order->ordered_quantity}}</span><br>
											Cost: <span class="inr">$ {{$rating->order->quantity->product->price * $rating->order->ordered_quantity}}</span><br>
											Delivery Status: <span class="text-bold">
												@if($rating->order->delivery_status == 0)
													Confirmed
												@elseif($rating->order->delivery_status == 1)
													Disptached
												@elseif($rating->order->delivery_status == 2)
													Delivered
												@else
													Cnacelled
												@endif
											</span>
										</p>
									</p>
								</div>
								<div class="col-md-6">
									<p>
										<span class="text-bold">Shipping Address:</span>
										<p>
											{{$rating->order->shipping->address}}<br>
											@if($rating->order->shipping->landmark != '')
												{{ $rating->order->shipping->landmark}}
												<br>
											@endif
											{{$rating->order->shipping->city}}<br>
											{{$rating->order->shipping->state}}<br>
											{{$rating->order->shipping->pincode}}<br>
										</p>
										<p>
											<span class="text-bold">Contact No.</span>
											{{$rating->order->user->mobile_no}}<br>
											<span class="text-bold">Email Id:</span>
											{{$rating->order->user->email}}
										</p>
									</p>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12">
									<p>
									Rating giver by user: <span class="text-bold"><a href="/admin/users/view/{{$rating->order->user->id}}">{{$rating->order->user->name}}</a></span><br>
									<br>
									@for($i = 1; $i <= $rating->rating; $i++)
									<i class="fa fa-star fa-2x"></i>
									@endfor
									@for($i = 0; $i < 5 - $rating->rating; $i++)
									<i class="fa fa-star-o fa-2x"></i>
									@endfor
									&nbsp;
									<span class="star-rating">{{$rating->rating}}</span>
									</p>
									<p>
										<b>Feedback:</b><br>
										{{$rating->feedback == NULL ? 'No Feddback given by user.' : $rating->feedback}}
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('css')
@include('admin.layouts.cart_cards')
@include('admin.layouts.resources')
@stop