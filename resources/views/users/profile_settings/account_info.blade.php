@extends('users.layouts.account_layout')
@section('title', 'Account Information')

@section('heading', 'Account Informaation')
@section('menu_container')
<style>
	.profile-container {
		margin-top: 30px;
		display: grid;
		grid-template-columns: 1fr;
		grid-gap: 20px;
		align-content: space-around;
	}
	.input-container {
		display: grid;
		grid-template-columns: 1fr 1.5fr;
	}
	sup {
		font-size: 0.9em;
		color: red;
	}
	#email-checkbox:checked + .email-row{
		display: inline
	}
	.email-row {
		display: none
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
	.password-input {
		display: none;
	}
	.chk-pwd {
		margin-bottom: 20px;
	}
</style>
<div class="container">
	<div class="col-md-12 menu-container">
		<h4>
			Account Information
		</h4>
		<div class="profile-container">
			<form action="/my/account_information/update" method="POST" id="peofile-form">
				<div class="input-container">
					<label for="name">Name <sup>*</sup></label>
					<input type="text" name="name" id="name" class="form-control" value="{{Auth::user()->name}}" required><br>
				</div>
				<div class="input-container">
					<label for="email">Email <sup>*</sup></label>
					<input type="email" name="email" id="email" class="form-control" value="{{Auth::user()->email}}" required><br>
				</div>
				<div class="input-container">
					<label for="mobile_no">Mobile No. <sup>*</sup></label>
					<input type="tel" name="mobile_no" id="mobile_no" class="form-control" value="{{Auth::user()->mobile_no}}" required><br>
				</div>
				<div class="input-container" id="password-input">
					<label for="new_password">New Password</label>
					<input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password"><br>
				</div>
				<div class="input-container">
					<label for="old_password">Enter Old Password To Make Changes: <sup>*</sup></label>
					<input type="password" name="old_password" id="old_password" class="form-control" placeholder="Old Password" required><br>
				</div><br>
				<div class="input-container">
					<p></p>
					<input type="submit" class="button" value="Update">
				</div>
				<br>
				@csrf
				@method('PUT')
			</form>
		</div>
	</div>
</div>
@stop