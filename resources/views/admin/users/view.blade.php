@extends('adminlte::page')

@section('title', 'Admin Panel :: View User')

@section('content_header')
     <center>
		<h2>Viewing User</h2>
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
						<td>
							Additional Information:
						</td>
						<td>
							Created At: {{$user->created_at}}<br>
							Created By: {{$user->created_by}}<br>
							Updated At: {{$user->updated_at}}<br>
							Updated By: {{$user->updated_by == '' ? 'NULL' : $user->updated_by}}
						</td>
					</tr>
					<tr>
					@if($user->isAdmin != 1)
						<td>
						</td>
						<td>
							<button class="btn btn-info"><i class="fa fa-shopping-cart" onclick="location.href='/admin/user/cart/{{$user->id}}'"> View Cart</i></button>
							<button class="btn btn-primary" style="background-color: #EF5350;" onclick="location.href='/admin/user/wishlist/{{$user->id}}'"><i class="fa fa-heart"> View Wishlist</i></button>
						</td>
					@endif
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