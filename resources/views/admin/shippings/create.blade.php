@extends('adminlte::page')

@section('title', 'Admin Panel :: Shippings')

@section('content_header')
    <center>
		<h2>Create a Shipping Address</h2>
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
								User Name:
							</td>
							<td>
								<select name="user" class="form-control">
									<option value="NULL" disabled selected>Select User</option>
									@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->name}}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Address:
							</td>
							<td>
								<input type="text" name="address" class="form-control" required>
							</td>
						</tr>
						<tr>
							<td>
								Landmark:
							</td>
							<td>
								<input type="text" class="form-control" placeholder="Optional" name="landmark">
							</td>
						</tr>
						<tr>
							<td>
								City:
							</td>
							<td>
								<input type="text" name="city" class="form-control" required>
							</td>
						</tr>
						<tr>
							<td>
								State:
							</td>
							<td>
								<select name="state" class="form-control" required>
									<option value="NULL" disabled selected>Select State</option>
									@foreach($states as $state)
										<option value="{{$state}}">{{$state}}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Pincode:
							</td>
							<td>
								<input type="tel" name="pincode" max="6" class="form-control" required>
							</td>
						</tr>
						<tr>
							<td>
								Status:
							</td>
							<td>
								<input type="checkbox" name="status">
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
