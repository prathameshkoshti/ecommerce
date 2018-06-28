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
			<form action="/admin/orders/update/{{$order->id}}" method="post">
				<table class="table table-borderless">
					<tr>
						<td>
							Product Image:
						</td>
						<td>
							@php
								$image = explode(',', $order->quantity->product->image_names);
							@endphp
							<img class="image" width="150px" height="150px" src="{{url('storage/'.$order->quantity->product->category->name.'/'.$image[0])}}" alt="{{$order->quantity->product->name}}">
						</td>
					</tr>
					<tr>
						<td>
							Product Name:
						</td>
						<td>
							{{$order->quantity->product->name}}
						</td>
					</tr>
					<tr>
						<td>
							Quantity:
						</td>
						<td>
							{{$order->ordered_quantity}}
						</td>
					</tr>
					<tr>
						<td>
							Size:
						</td>
						<td>
							{{$order->quantity->size->name}}
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
							<select name="delivery_status" id="delivery_status" class="form-control" onChange="changetextbox();">
								<option value="0" {{$order->delivery_status == 0 ? 'selected' : ''}}>Confirmed</option>
								<option value="1" {{$order->delivery_status == 1 ? 'selected' : ''}}>Dispatched</option>
								<option value="2" {{$order->delivery_status == 2 ? 'selected' : ''}}>Delivered</option>
								<option value="3" {{$order->delivery_status == 3 ? 'selected' : ''}}>Cancelled</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Cancellation Reason:
						</td>
						<td>
							<textarea name="cancellation_reason" id="cancellation_reason" class="form-control" cols="30" rows="5" {{$order->delivery_status != 3 ? 'disabled' : ''}}>{{$order->cancellation_reason}}</textarea>
						</td>
					</tr>
					<tr>
						<td>
							Action date:
						</td>
						<td>
							<input value="{{$order->action_date}}" type="date" name="action_date" class="form-control">
						</td>
					</tr>
					<tr>
						<td>
							Status
						</td>
						<td>
							<input type="checkbox" name="status" {{$order->status == 1 ? 'checked' : ''}}>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" value="Update" class="btn btn-success">
						</td>
					</tr>
				</table>
				@csrf
				@method('PUT')
			</form>
		</div>
	</div>
</div>
@stop


@section('css')
@include('admin.layouts.resources')
@stop

@section('js')
	<script>
		function changetextbox()
		{
			if (document.getElementById("delivery_status").value === "3") {
				document.getElementById("cancellation_reason").disabled='';
			} else {
				document.getElementById("cancellation_reason").disabled='true';
			}
		}
	</script>
@stop