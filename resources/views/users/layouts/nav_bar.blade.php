@extends('users.layouts.master')

@section('title', 'Home')
<style>
	/* #region */
	@font-face{
		font-family: 'Valencia';
		src: local('Valencia Italic.ttf');
	}
	/* cyrillic */
	@font-face {
		font-family: 'Montserrat';
		font-style: normal;
		font-weight: 400;
		src: local('Montserrat Regular'), local('Montserrat-Regular'), url(https://fonts.gstatic.com/s/montserrat/v12/JTUSjIg1_i6t8kCHKm459W1hyyTh89ZNpQ.woff2) format('woff2');
		unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
	}
	/* cyrillic */
	@font-face {
		font-family: 'Montserrat';
		font-style: normal;
		font-weight: 600;
		src: local('Montserrat SemiBold'), local('Montserrat-SemiBold'), url(https://fonts.gstatic.com/s/montserrat/v12/JTURjIg1_i6t8kCHKm45_bZF3g3D_vx3rCubqg.woff2) format('woff2');
		unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
	}
	/* #endregion */
	.left-nav{
		margin-right: 5%;
	}
	.fa{
		color: #212121 !important;
	}
	.email{
		font-size: .7em;
	}
	.undandy-logo{
		transform: scale(0.9);
	}
	.undandy-hidden{
		transform: scale(0.8);
		display: inline;
	}
	.banner-btn{
		background: rgb(255,169,0);
		border-radius: 0px !important;
		color: #fff;
		font-family: 'Montserrat';
		letter-spacing: 2pt;
		padding: 5px 10px !important;
		font-weight: 600;
	}
	.banner{
		position: absolute;
	}

	.text{
		background: rgba(0%, 0%, 0%, 0.6);
		font-family: 'Valencia';
		letter-spacing: 1pt;
		margin-top: 4%;
		padding: 10%;
	}

	.navbar-hr{
		margin-top: -0.5%;
	}
	@media only screen and (min-width: 1080px) {
		/* For mobile phones: */
		.banner{
		clip: rect(0px,1170px,400px,0px);
		}
		.orange{
			background: rgba(255,169,0,0.4);
			position: absolute;
			height: 40px;
			margin-left: 4%;
			max-width: 100%;
		}
		.banner-content{
			position: relative;
			color: #fff;
			padding: 0.5%;
			padding-top: 5%;
			margin-left: 4%;
			padding-bottom: 9.9%;
			max-width: 70%;
		}
		.navbar{
			margin-left: 35%;
		}
		.undandy-hidden{
			display: none;
		}
		.nav-text-item{
			margin-left: 5% !important;
			margin-right: 10% !important;
			margin-top: 7% !important;
		}
		.right-nav{
			margin-left: 0%;
			margin-top: 4%;
			position: relative;
			right: -35%;
			float: right;
		}
		.wishlist, .cart{
			margin-top: 8%;
		}
	}
	@media only screen and (max-width: 1080px) {
		/* For mobile phones: */
		.banner{
			clip: rect(0px,600px,400px,0px);
		}
		.banner-bg{
			overflow: hidden;
		}
		.banner-content{
			width: 100%;
			position: relative;
			background: rgba(0%, 0%, 0%, 0.2);
			color: #fff;
		}
		.undandy-logo{
			display: none;
		}
		.text > h2{
			font-size: 1em
		}
		.text > p{
			font-size: 0.8em
		}
	}
</style>
@section('body')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 offset-md-1">
			<nav class="navbar navbar-expand-lg navbar-light">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<a class="nav-brand" href="#">
					<img class="undandy-hidden"src="{{ url('storage/logo.png') }}">
				</a>
				<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
					<ul class="navbar-nav main-nav">
						<li class="nav-text-item active">
							<a class="nav-link" href="#">Shoes</a>
						</li>
						<li class="active">
							<a class="nav-link" href="#">
								<img class="undandy-logo"src="{{ url('storage/logo.png') }}">
							</a>
						</li>
						<li class="nav-text-item active">
							<a class="nav-link disabled" href="#">Accessories</a>
						</li>
					</ul>

					<ul class="navbar-nav right-nav">
						<li class="nav-item user dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-user"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								@if(!Auth::user())
									<a class="dropdown-item" href="login">Login</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="register">Sign Up</a>
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
							<a href="/my/wishlist" class="active"><i class="fa fa-heart"></i></a>
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