@extends('adminlte::page')

@section('title', 'Admin Panel :: Orders')

@section('content_header')
	<center>
		<h2>Ordered by User: {{$order->user->name}}</h2>
		<br>
	</center>
@stop

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-4">
			<table class="table table-borderless">
				<tr>
					<td>
						Product Image:
					</td>
					<td>
						@php
							$image = explode(',', $order->product->image_names);
						@endphp
						<img class="image" width="150px" height="150px" src="{{url('storage/'.$order->product->category->name.'/'.$image[0])}}" alt="{{$order->product->name}}">
					</td>
				</tr>
				<tr>
					<td>
						Product Name:
					</td>
					<td>
						{{$order->product->name}}
					</td>
				</tr>
				<tr>
					<td>
						Quantity:
					</td>
					<td>
						{{$order->quantity}}
					</td>
				</tr>
				<tr>
					<td>
						Size:
					</td>
					<td>
						{{$order->size}}
					</td>
				</tr>
				<tr>
					<td>
						Price:
					</td>
					<td>
						{{$order->price}}
					</td>
				</tr>
				<tr>
					<td>
						Ordered Placed on:
					</td>
					<td>
						{{$order->order_date}}
					</td>
				</tr>
				<tr>
					<td>
						Shipping Address:
					</td>
					<td>
						{{$order->shipping->address}}<br>
						{{$order->shipping->city}}<br>
						{{$order->shipping->state}}<br>
						{{$order->shipping->pincode}}
					</td>
				</tr>
				<tr>
					<td>
						Delivery Status:
					</td>
					<td>
						@if($order->delivery_status == 0)
							Pending
						@elseif($order->delivery_status == 1)
							Dispatched
						@elseif($order->delivery_status == 2)
							Delivered
						@else
							Cancelled
						@endif
					</td>
				</tr>
				@if($order->delivery_status == 3)
				<tr>
					<td>
						Cancellation Reason:
					</td>
					<td>
						{{$order->cancellation_reason}}
					</td>
				</tr>
				@endif
				<tr>
					<td>
						Action date:
					</td>
					<td>
						{{$order->action_date == '' ? 'NULL' : $order->action_date}}
					</td>
				</tr>
				<tr>
					<td>
						Status
					</td>
					<td>
						{{$order->status == 1 ? 'Active' : 'Inactive'}}
					</td>
				</tr>
				<tr>
					<td>
						Additional Information:
					</td>
					<td>
						Created By: {{$order->createdBy->name}}<br>
						Created At: {{$order->created_at}}<br>
						Updated By: {{$order->updatedBy->name}}<br>
						Updated By: {{$order->updated_at}}
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
@stop


@section('css')
@include('layouts.resources')
@stop

@section('js')
@stop