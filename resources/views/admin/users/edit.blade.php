@extends('adminlte::page')

@section('title', 'Admin Panel :: Users')

@section('content_header')
    <center>
		<h2>Editing User:{{$user->name}}</h2>
		<br>
    </center>
@stop

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form method="POST" action="/admin/users/update/{{$user->id}}">
					<table class="table table-borderless">
						<tr>
							<td>
								Name:
							</td>
							<td>
							<input type="text" name="name" class="form-control" value="{{$user->name}}" required>
							</td>
						</tr>
						<tr>
							<td>
								Email:
							</td>
							<td>
								<input type="email" name="email" class="form-control" value="{{$user->email}}" required>
							</td>
						</tr>
						<tr>
							<td>
								Password:
							</td>
							<td>
								<input type="password" name="password" minlength="5" class="form-control" placeholder="Change only if it is necessary!">
							</td>
						</tr>
						<tr>
							<td>
								Mobile No.:
							</td>
							<td>
								<input type="tel" name="mobile_no" class="form-control"  value="{{$user->mobile_no}}"required>
							</td>
						</tr>
						<tr>
							<td>
								Is Admin:
							</td>
							<td>
								@if($user->isAdmin == 1)
									<input type="checkbox" name="isadmin" checked>
								@else
									<input type="checkbox" name="isadmin">
								@endif
							</td>
						</tr>
						<tr>
							<td>
								Status:
							</td>
							<td>
								@if($user->status == 1)
									<input type="checkbox" name="status" checked>
								@else
									<input type="checkbox" name="status">
								@endif
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="submit" class="btn btn-success" value="Submit">
							</td>
						</tr>
					</table>
					@method('PUT')
					@csrf
				</form>
			</div>
		</div>
	</div>
	@include('admin.layouts.resources')
@stop
