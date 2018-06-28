@if(Session :: has('warning'))
<div class="col-md-4 alert alert-warning alert-dismissible col-md-offset-4">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p class="font-weight-bold flash label label-warning"><h5>{{Session :: get('warning')}}</h5></p>
</div>
@endif
@if(Session :: has('success'))
<div class="col-md-4 alert alert-success alert-dismissible col-md-offset-4">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p class="font-weight-bold flash label label-success"><h5>{{Session :: get('success')}}</h5></p>
</div>
@endif
@if(Session :: has('danger'))
<div class="col-md-4 alert alert-danger alert-dismissible col-md-offset-4">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p class="font-weight-bold flash label label-danger font-weight-bold"><h5>{{Session :: get('danger')}}</h5></p>
</div>
@endif
<div class="row">
	@if( $errors->any() )
		<div class="col-md-ofsset-4 col-md-4">
			@foreach($errors->all() as $error)
				<div class="alert alert-danger col-md-12">
					<ul>
					<li>{{$error}}</li>
					</ul>
				</div>
			@endforeach
		</div>
	@endif
</div>
<style>
	button i.fa-pencil, button i.fa-trash {
		color: #fff;
	}
	.fa-trash{
		color: #EF5350;
	}

	.fa-pencil{
		color: #FFCA28;
	}

	.fa-eye{
		color: #42A5F5;
	}

	.product-images:hover{
		transform: scale(2);
	}

	.product-images{
		transition: 0.5s ease-out;
	}

	.inr{
		font-size: 1.2em;
	}

	.btn{
		border: 0px !important;
		width: 100px;
	}

	.btn-success{
		background-color: #6553ad;
	}

	.btn-success:hover{
		background-color: #59499e;
	}

	.chng-pass{
		width: 10em;
	}

	.update-profile{
		width: 8em;
	}

	.table-borderless tbody+tbody,.table-borderless td,.table-borderless th,.table-borderless thead th{
		border:0 !important;
	}

	.alert{
		position: fixed;
		top:0px;
		z-index: 9999999999999999;
		border: 0px;
	}

	.search-wrapper{
		text-align: center;
	}

	.search{
		display: inline-block;
		border-radius: 50px;
		border: 0px;
	}

	.slider-container{
		width: 100%;
	}

	.slider {
		-webkit-appearance: none;
		width: 80%;
		height: 10%;
		background: #d3d3d3;
		outline: none;
		opacity: 0.7;
		-webkit-transition: .2s;
		transition: opacity .2s;
	}

	.slider:hover {
		opacity: 1;
	}

	.slider::-webkit-slider-thumb {
		-webkit-appearance: none;
		appearance: none;
		width: 20px;
		height: 20px;
		background: #6553ad;
		cursor: pointer;
	}

	.slider::-moz-range-thumb {
		width: 20px;
		height: 20px;
		background: #6553ad;
		cursor: pointer;
	}

	.pagination-wrapper {
		text-align: center;
	}
	.paginate {
		display: inline-block;
	}
</style>