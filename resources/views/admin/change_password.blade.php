@extends('adminlte::page')

@section('title', 'Admin Panel :: Profile')

@section('content_header')
	<center>
		<h2>Profile: {{Auth::user()->name}}</h2>
		<br>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<form action="/admin/update_password" method="POST">
						<table class="table table-borderless">
							<tr>
								<td>
									<input type="password" placeholder="Old Password" minlength="5" name="old_password" class="form-control" id="" required>
								</td>
							</tr>
							<tr>
								<td>
									<input type="password" placeholder="New Password" minlength="5" class="form-control" name="new_password" id="" required>
								</td>
							</tr>
							<tr>
								<td>
									<input type="submit" value="Change Password" class="btn btn-success form-control">
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
