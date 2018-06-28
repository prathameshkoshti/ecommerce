@extends('users.layouts.account_layout')
@section('title', 'Account Dashboard')

@section('heading', 'Dashboard')
@section('menu_container')
<div class="container">
	<div class="col-md-12 menu-container">
		<h4>
			Account Information
		</h4>
		<br><br>
		<h5>
			Contact information
		</h5>
		<p>
			{{Auth::user()->name}}<br>
			{{Auth::user()->email}}<br>
			{{Auth::user()->mobile_no}}<br>
			<br>
			<a class="link" href="/my/account_information"><u>Edit</u></a>
		</p>
	</div>
	<div class="col-md-12 menu-container">
		<h4>
			Address Book
		</h4>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="/my/address_book" class="link"><u>Manage Addresses</u></a>
		<br>
		<br>
		@if(!$shipping)
			<div class="col-md-12 alert alert-warning">
				<p class="font-weight-bold flash label label-warning"><h5>No shipping addresses found.</h5></p>
			</div>
		@else
		<p>
			{{$shipping->address}}<br>
			@if($shipping->landmark)
				{{$shipping->landmark}}
				<br>
			@endif
			{{$shipping->city}}<br>
			{{$shipping->state}}<br>
			{{$shipping->pincode}}<br>
		</p>
		@endif
	</div>
</div>
@stop