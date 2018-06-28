<style>
</style>
@if(Session :: has('warning'))
<div class="col-md-12 alert alert-dismissible alert-warning">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p class="font-weight-bold flash label label-warning"><h5>{{Session :: get('warning')}}</h5></p>
</div>
@endif
@if(Session :: has('success'))
<div class="col-md-12 alert alert-dismissible alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p class="font-weight-bold flash label label-success"><h5>{{Session :: get('success')}}</h5></p>
</div>
@endif
@if(Session :: has('danger'))
<div class="col-md-12 alert alert-dismissible alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p class="font-weight-bold flash label label-danger font-weight-bold"><h5>{{Session :: get('danger')}}</h5></p>
</div>
@endif
<div class="row">
	@if( $errors->any() )
		<div class=" col-md-12">
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