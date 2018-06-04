@extends('adminlte::page')

@section('title', 'Admin Panel :: Shipping Addresses')

@section('content_header')
	<center>
		<h2>Shipping Addresses of User: {{$shipping->user->name}}</h2>
		<br>
	</center>
@stop

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 cards-holder">
			<h3>Address</h3>
			<br>
				<div class="row">
					<br>
					<div class="col-md-4">
						<p>
							{{$shipping->address}}<br>
							<em>{{$shipping->landmark}}</em><br>
							{{$shipping->city}}<br>
							{{$shipping->pincode}}<br>
							{{$shipping->state}}<br>
							Ststus: {{$shipping->status == 1 ? 'Active' : 'Inactive'}}
						</p>
						<br>
						<button class="btn btn-warning"  onclick="location.href='/admin/shippings/edit/{{$shipping->id}}'">
							<i class="fa fa-pencil fa-lg"></i> Edit
						</button>
						<button class="btn btn-danger" onclick="location.href='/admin/shippings/delete/{{$shipping->id}}'">
							<i class="fa fa-trash fa-lg"></i> Delete
						</button>
					</div>
				</div>
			<hr>
			<h3>Other Addresses</h3>
			<br>
				<div class="row">
					@foreach($other_addresses as $shipping)
					<div class="col-md-4">
						<br>
						<p>
							{{$shipping->address}}<br>
							<em>{{$shipping->landmark}}</em><br>
							{{$shipping->city}}<br>
							{{$shipping->pincode}}<br>
							{{$shipping->state}}<br>
							Ststus: {{$shipping->status == 1 ? 'Active' : 'Inactive'}}
						</p>
						<br>
						<button class="btn btn-warning"  onclick="location.href='/admin/shippings/edit/{{$shipping->id}}'">
							<i class="fa fa-pencil fa-lg"></i> Edit
						</button>
						<button class="btn btn-danger" onclick="location.href='/admin/shippings/delete/{{$shipping->id}}'">
							<i class="fa fa-trash fa-lg"></i> Delete
						</button>
					</div>
					@endforeach
				</div>
			<br>
		</div>
	</div>
</div>
@stop


@section('css')
@include('admin.layouts.cart_cards')
@stop

@section('js')
@stop