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
				<form method="POST" action="/admin/shippings/update/{{$shipping->id}}">
					<table class="table table-borderless">
						<tr>
							<td>
								User Name:
							</td>
							<td>
								<select name="user" class="form-control">
									<option value="NULL" disabled selected>Select User</option>
									@foreach($users as $user)
									<option value="{{$user->id}}" {{$user->id == $shipping->user_id ? 'selected' : ''}}>{{$user->name}}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Address:
							</td>
							<td>
								<input type="text" value="{{$shipping->address}}" name="address" class="form-control" required>
							</td>
						</tr>
						<tr>
							<td>
								Landmark:
							</td>
							<td>
								<input type="text" value="{{$shipping->landmark}}" class="form-control" placeholder="Optional" name="landmark">
							</td>
						</tr>
						<tr>
							<td>
								City:
							</td>
							<td>
								<input type="text" value="{{$shipping->city}}" name="city" class="form-control" required>
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
										<option value="{{$state}}" {{$shipping->state === $state ? 'selected' : ''}}>{{$state}}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Pincode:
							</td>
							<td>
								<input type="tel" value="{{$shipping->pincode}}" max="6" name="pincode" class="form-control" required>
							</td>
						</tr>
						<tr>
							<td>
								Status:
							</td>
							<td>
								<input type="checkbox" name="status" {{$shipping->status == 1 ? 'checked' : ''}}>
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
