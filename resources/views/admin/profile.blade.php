@extends('adminlte::page')

@section('title', 'Admin Panel :: Profile')

@section('content_header')
     <center>
		<h2>Profile: {{Auth::user()->name}}</h2>
		<br>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<form action="profile/update" method="POST">
						<table class="table table-borderless">
							<tr>
								<td>
									User Type:
								</td>
								<td>
									@if(Auth::user()->isAdmin == 1)
										Admin
									@else
										Normal User
									@endif
								</td>
							</tr>
							<tr>
								<td>
									Name:
								</td>
								<td>
									<input type="text" class="form-control" value="{{Auth::user()->name}}" name="name" id="" required>
								</td>
							</tr>
							<tr>
								<td>
									Email Id:
								</td>
								<td>
									<input type="email" name="email" class="form-control" value="{{Auth::user()->email}}" id="" required>
								</td>
							</tr>
							<tr>
								<td>
									Mobile No.:
								</td>
								<td>
									<input type="tel" name="mobile_no" class="form-control" value="{{Auth::user()->mobile_no}}" id="" required>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="submit" value="Update Profile" class="btn btn-success update-profile">
								</td>
							</tr>
						</table>
						@csrf
						@method('PUT')
					</form>
				</div>
			</div>
		</div>
	</center>
@stop
@section('css')
@include('layouts.resources')
@stop
