@extends('users.layouts.account_layout')
@section('title', 'Create New Address')

@section('heading', 'Address Book')
@section('menu_container')
<style>
	sup {
		color: red;
		font-size: 0.9em;
	}
	table {
		margin-top: 30px;
	}
	.button {
		color:#ffa900;
		width: 10em;
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
</style>
<div class="container">
	<div class="col-md-12 menu-container">
		<h4>
			New Address
		</h4>
		<form action="store" id="create-address" method="POST">
			<table class="table table-borderless">
				<tr>
					<td>
						Street Address <sup>*</sup>
					</td>
					<td>
						<input type="text" name="address" class="form-control" id="" required>
					</td>
				</tr>
				<tr>
					<td>
						Landmark
					</td>
					<td>
						<input type="text" name="landmark" class="form-control" id="">
					</td>
				</tr>
				<tr>
					<td>
						City <sup>*</sup>
					</td>
					<td>
						<input type="text" name="city" class="form-control" id="" required>
					</td>
				</tr>
				<tr>
					<td>
						State <sup>*</sup>
					</td>
					<td>
						<select name="state" id="" required class="form-control">
							<option value="NULL" disabled selected>Select State</option>
							@foreach($states as $state)
								<option value="{{$state}}">{{$state}}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Pincode <sup>*</sup>
					</td>
					<td>
						<input type="tel" name="pincode" max="6" class="form-control" required>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" value="Create" class="button">
					</td>
				</tr>
			</table>
			@method('PUT')
			@csrf
		</form>
	</div>
</div>
@stop