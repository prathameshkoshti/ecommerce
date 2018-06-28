@extends('adminlte::page')

@section('title', 'Admin Panel :: Users')

@section('content_header')
    <center>
		<h2>Viewing User: {{$user->name}}</h2>
		<br>
    </center>
@stop

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<table class="table table-borderless">
					<tr>
						<td>
							Name
						</td>
						<td>
							{{$user->name}}
						</td>
					</tr>
					<tr>
						<td>
							Email
						</td>
						<td>
							{{$user->email}}
						</td>
					</tr>
					<tr>
						<td>
							Phone No.:
						</td>
						<td>
							{{$user->mobile_no}}
						</td>
					</tr>
					<tr>
						<td>
							Password(Encrypted)
						</td>
						<td>
							{{$user->password}}
						</td>
					</tr>
					<tr>
						<td>
							Status
						</td>
						<td>
							@if($user->status == 1)
								Active
							@else
								Inactive
							@endif
						</td>
					</tr>
					<tr>
					@if($user->isAdmin != 1)
						<td>
						</td>
						<td>
							<button class="btn btn-info"><i class="fa fa-shopping-cart" onclick="location.href='/admin/carts/view/{{$user->id}}'"> Cart</i></button>
							<button class="btn btn-primary" style="background-color: #EF5350;" onclick="location.href='/admin/wishlists/view/{{$user->id}}'"><i class="fa fa-heart"> Wishlist</i></button>
						</td>
					@endif
					</tr>
					<tr>
						<td></td>
						<td>
							<button class="btn btn-warning" onclick="location.href='/admin/users/edit/{{$user->id}}'"><i class="fa fa-pencil fa-lg"></i> Edit</button>
							<button class="btn btn-danger" onclick="location.href='/admin/users/delete/{{$user->id}}'"><i class="fa fa-trash fa-lg"></i> Delete</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
@stop

@section('css')
@include('admin.layouts.resources')
@stop

@section('js')
@stop