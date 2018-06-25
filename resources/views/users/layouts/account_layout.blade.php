@extends('users.layouts.nav_bar')
<style>
	.heading {
		font-size: 2.5em;
		font-family: 'Valencia';
		margin-left: 5%;

	}
	.heading:before {
		content: " ";
		width: 0.5em;
		height: 1px;
		border-bottom: 1px solid #ffa900;
		position: absolute;
		top: 1em;
		left: 0em;
	}
	.head::before{
		content: " ";
		height: 1.5em;
		width: 1px;
		-webkit-transform: rotate(35deg);
		transform: rotate(35deg);
		position: absolute;
		left: 1em;
		top: 0.3em;
		border-left: 1px solid #ffa900
	}
	@media only screen and (max-width: 1080px) {
	.head{
		position: relative;
		left: 0.6em;
	}
	.heading::before {
		left: 0.5em
	}
	.head:before{
		position: absolute;
		left: -0.3em;
		top: -0.1em;
		-webkit-transform: rotate(35deg);
    	transform: rotate(35deg);
	}
}
.account-menu {
	height: auto;
	margin-left: -30px;
}
.account-menu li {
	background: #F1F1F1;
	list-style-type: none;
	padding: 10px;
	color: #000;
	padding: 15px 30px;
}
.menu-container {
	background: #F1F1F1;
	padding: 10px 20px
}
.act {
	border-left: 4px solid #ffa900;
	font-weight: 600;
}
.menu-container > p {
	font-size: 0.9em;
}
.link {
	color: #212121;
	font-size: 0.8em;
}
.container {
	display: grid;
	grid-template-rows: 1fr;
	grid-gap: 20px;
}
h4 {
	font-size: 1.3em !important;
	display: inline;
}
h5 {
	font-size: 1em !important;
	font-weight: 900;
}
</style>
<br><br><br><br>
@section('body-content')
<div class="heading">
	<div class="head">
		@yield('heading')
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-3">
				<ul class="account-menu">
					@php
					$url = url()->current();
					$url_part = explode('/', $url);
					@endphp
					<a href="/my/account_dashboard">
						<li class="{{in_array('account_dashboard', $url_part) ? 'act' : ''}}">Account Dashboard</li>
					</a>
					<a href="/my/orders">
						<li class="{{in_array('orders', $url_part) ? 'act' : ''}}">My Orders</li>
					</a>
					<a href="/my/wishlist">
						<li class="{{in_array('wishlist', $url_part) ? 'act' : ''}}">My Wishlist</li>
					</a>
					<a href="/my/address_book">
						<li class="{{in_array('address_book', $url_part) ? 'act' : ''}}">Address Book</li>
					</a>
					<a href="/my/account_information">
						<li class="{{in_array('account_information', $url_part) ? 'act' : ''}}">Account Information</li>
					</a>
					<a href="/my/reviews">
						<li class="{{in_array('reviews', $url_part) ? 'act' : ''}}">My Reviews</li>
					</a>
				</ul>
			</div>
			<div class="col-md-9">
				@include('users.layouts.resources')
				@yield('menu_container')
			</div>
		</div>
	</div>
</div>
@yield('account_information')
@stop