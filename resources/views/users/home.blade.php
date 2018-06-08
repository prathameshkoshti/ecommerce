@extends('users.layouts.nav_bar')
@section('title', 'Undandy :: Home')
@section('body-content')
	<div class="row">
		<div class="col-md-12">
			<div class="banner-bg">
				<img class="banner img-fluid"src="{{ url('storage/banner.jpg') }}">
				<div class="banner-content">
					<div class="text">
						<h2>CREATE YOUR LEGACY</h2>
						<br>
						<p>
							Unleash your creative genius by customising shoes as authentic and <br>
							utterly unique as you are
						</p>
						<p>
						<div>
							<button class="banner-btn btn">
								SHOP
							</button>
						</div>
						</p>
					</div>
				</div>
			</div>
			
		</div>
	</div>
@stop