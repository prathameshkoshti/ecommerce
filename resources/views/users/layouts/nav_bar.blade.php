@extends('users.layouts.master')

@section('title', 'Home')
@section('body')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 offset-md-1">
			<nav class="navbar navbar-expand-lg navbar-light fixed-top">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<a class="nav-brand" href="/">
					<img class="undandy-hidden"src="{{ url('storage/logo.png') }}">
				</a>
				<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
					<ul class="navbar-nav main-nav">
						<li class="nav-text-item active shoes-dropdown">
							<a class="nav-link dropdown">Shoes</a>
							<div id="shoes-menu">
								<div class="row">
									<div class="col-md-6">
										<div class="row">
											<i class="slash-menu"></i><i class="menu-head">BY TYPE</i>
											<br>
											<ul class="menu-items">
												<a href="/category/oxford" class="dropdown-item">
													<li>
														Shoes
													</li>
												</a>
												<a href="/category/boots" class="dropdown-item">
													<li>
														Boots
													</li>
												</a>
												<a href="/category/sneakers" class="dropdown-item">
													<li>
														Sneakers
													</li>
												</a>
												<a href="/category/patinas" class="dropdown-item">
													<li>
														Patinas
													</li>
												</a>
												<a href="/category/all" class="dropdown-item">
													<li>
														All
													</li>
												</a>
											</ul>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<img class=" menu-image"src="{{ url('storage/the-collections_s.jpg') }}">
										</div>
									</div>
								</div>
							</div>
						</li>

						<li class="active">
							<a class="nav-link" href="/">
								<img class="undandy-logo"src="{{ url('storage/logo.png') }}">
							</a>
						</li>
						<li class="nav-text-item active">
							<a class="nav-link disabled" href="/accessories">Accessories</a>
						</li>
					</ul>

					<ul class="navbar-nav right-nav">
						<li class="nav-item search" onclick="toggleSearch();">
							<i class="fa fa-search" id="search-icon"></i>
						</li>
						<div id="search-form">
							<form method="GET" onsubmit="search();" id="form-search">
								<input type="text" id="search-input" onclick="focus();" autofocus><i class="fa fa-search btn-search"></i>
							</form>
						</div>
						<li class="nav-item user dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-user"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								@if(!Auth::user())
									<a class="dropdown-item" href="/login">Login</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="/register">Sign Up</a>
								@else
									<a class="dropdown-item" href="#">
										{{Auth::user()->name}}<br>
										<em class="email"><i class="fa fa-user"></i> {{Auth::user()->email}}</em>
									</a>
									<a class="dropdown-item" href="#">Orders</a>
									<div class="dropdown-divider"></div>
										@if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
											<a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
												{{ trans('adminlte::adminlte.log_out') }} <i class="fa fa-sign-out-alt fa-lg"></i>
											</a>
										@else
											<a class="dropdown-item" href="#"
											onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
											>
												{{ trans('adminlte::adminlte.log_out') }} <i class="fa fa-sign-out-alt"></i>
											</a>
											<form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
												@if(config('adminlte.logout_method'))
													{{ method_field(config('adminlte.logout_method')) }}
												@endif
												{{ csrf_field() }}
											</form>
										@endif
									</div>
								@endif
						</li>&nbsp;&nbsp;
						<li class="nav-item wishlist">
							<a href="/my/wishlist" class="active"><i class="fas fa-heart"></i></a>
						</li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<li class="nav-item cart">
							<a href="/my/cart" class=""><i class="fa fa-shopping-bag"></i></a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 offset-md-1">
			<hr class="navbar-hr">
			@yield('body-content')
		</div>
	</div>
</div>
@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	function toggleSearch(){
		var search = document.getElementById("search-form");
		var search_icon = document.getElementById("search-icon");
		var search_input = document.getElementsByName("search");
		if (search.style.display === "none") {
			search.style.display = "block";
			console.log('Display');
		} else {
			search.style.display = "none";
			console.log('Hidden');
		}
	}
	$(document).ready(function(){
		$("#form-search").submit(function(){
			let s = $("#search-input").val();
			console.log(s);
			$('#form-search').prop('action', '/search/'+s);
		});

		$(".shoes-dropdown").click(function(){
			$("#shoes-menu").toggle();
		});
	});
</script>