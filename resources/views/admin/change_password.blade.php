@extends('adminlte::page')

@section('title', 'Admin Panel :: Profile')

@section('content_header')
	<center>
		<h2>Profile: {{Auth::user()->name}}</h2>
		<br>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-5">
					<form action="update_password" method="POST">
						<table class="table tab-borderless">
							<tr>
								<td>
									<input type="password" placeholder="Old Password" name="old_password" class="form-control" id="">
								</td>
							</tr>
							<tr>
								<td>
									<input type="password" placeholder="New Password" class="form-control" name="new_password" id="">
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
	@include('layouts.resources')
@stop
