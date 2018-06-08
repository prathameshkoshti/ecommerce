<style>
	.info-container{
		border: 1px solid #BDBDBD;
		border-radius: 5px;
		width: 100%;
		height: auto;
		margin-top: 15%;
	}
	.right-side{
		float: right !important;
		position: relative !important;
		right: 0 !important;
	}
	.menu{
		position: relative;
		top: 0;
		left: -40;
	}
	.menu-item{
		list-style-type: none;
		padding-top: 11%;
		padding-bottom: 11%;
		padding-left: 10%;
		padding-right: 10%;
	}
	.vr{
		border: 1px solid #616161;
		width: 0px;
		height: 20%;
		float: left;
	}
</style>
@if(Session :: has('warning'))
<div class="col-md-4 alert alert-warning col-md-offset-4">
    <p class="font-weight-bold flash label label-warning"><h5>{{Session :: get('warning')}}</h5></p>
</div>
@endif
@if(Session :: has('success'))
<div class="col-md-4 alert alert-success col-md-offset-4">
    <p class="font-weight-bold flash label label-success"><h5>{{Session :: get('success')}}</h5></p>
</div>
@endif
@if(Session :: has('danger'))
<div class="col-md-4 alert alert-danger col-md-offset-4">
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