<div class="container-fluid">
	<div class="row">
		<div class="col-sm	-offset-2 col-sm-8">
			<div class="info-container">
				<div class="row">
					<div class="col-sm-3">
						<ul class="menu">
							<a href="/my/profile">
								<li class="menu-item">
									Profile
								</li>
							</a>
							<a href="/my/orders">
								<li class="menu-item">
									Orders
								</li>
							</a>
							<a href="/my/shipping_addresses">
								<li class="menu-item">
										Shipping Addresses
								</li>
							</a>
						</ul>
					</div>
					<div class="col-sm-1">
						<hr class="vr">
					</div>
					<div class="col-sm-8">
						@yield('settings-content')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>