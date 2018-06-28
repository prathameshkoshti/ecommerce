@extends('users.layouts.account_layout')
@section('title', 'Address Book')

@section('heading', 'Address Book')
@section('menu_container')
<style>
	.address-container {
		margin-top: 30px;
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		grid-gap: 20px;
	}
	.address {
		background: rgba(255, 255, 255, 0.5);
		padding: 20px;
		display: flex;
		flex-direction: column;
		height: 100%;
	}
	.address-operations {
		align-self: flex-end;
	}
	.button {
		color:#ffa900;
		background: #fff;
		padding: 5px 10px;
		border: 2px solid #ffa900;
		transition: 0.6s ease;
	}
	.button:hover {
		color: #fff;
		background: #ffa900;
		cursor: pointer;
		transition: 0.6s ease;
	}
	.create-button {
		margin-top: 30px;
		text-align: right;
	}
	@media only screen and (max-width:1080px) {
		.address-container {
			grid-template-columns: repeat(2, 1fr);
		}
	}
</style>
<div class="container">
	<div class="col-md-12 menu-container">
		<h4>
			Address Book
		</h4>
		@if($shippings->isEmpty())
			<br><br>
			<div class="col-md-12 alert alert-warning">
				<p class="font-weight-bold flash label label-warning"><h5>No shipping addresses found.</h5></p>
			</div>
		@else
		<div class="address-container">
			@foreach($shippings as $shipping)
			<div class="address">
				<div class="address-info">
					{{$shipping->address}}<br>
					@if($shipping->landmark)
						{{$shipping->landmark}}<br>
					@endif
					{{$shipping->city}}<br>
					{{$shipping->state}}<br>
					{{$shipping->pincode}}<br><br>
				</div>
				@if(!$shipping->landmark)
					<br>
				@endif
				<div class="address-operations">
					<u><a class="link" href="/my/address_book/edit/{{$shipping->id}}">Edit</a></u>&nbsp;&nbsp;&nbsp;
					<u><a class="link" href="/my/address_book/delete/{{$shipping->id}}">Delete</a></u>
				</div>
			</div>
			@endforeach
		</div>
		<div class="pagination-wrapper">
			<div class="paginate">
				{{$shippings->render()}}
			</div>
		</div>
		@endif
		<div class="create-button">
			<button class="button" onclick="location.href='/my/address_book/create'"><i class="fa fa-plus"></i> Create New Address</button>
		</div>
	</div>
</div>
@stop