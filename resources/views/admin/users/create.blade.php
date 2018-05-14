@extends('adminlte::page')

@section('title', 'Admin Panel :: Users')

@section('content_header')
     <center>
		<h2>Create a User</h2>
		<br>
     </center>
@stop

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form method="POST" action="store">
					<table class="table table-borderless">
						<tr>
							<td>
								Name:
							</td>
							<td>
								<input type="text" name="name" class="form-control" required>
							</td>
						</tr>
						<tr>
							<td>
								Email:
							</td>
							<td>
								<input type="email" name="email" class="form-control" required>
							</td>
						</tr>
						<tr>
							<td>
								Password:
							</td>
							<td>
								<input type="password" name="password" minlength="5" class="form-control" required>
							</td>
						</tr>
						<tr>
							<td>
								Mobile No.:
							</td>
							<td>
								<input type="tel" name="mobile_no" class="form-control" required>
							</td>
						</tr>
						<tr>
							<td>
								Is Admin:
							</td>
							<td>
								<input type="checkbox" name="isadmin" class="">
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
	@include('layouts.resources')
@stop
