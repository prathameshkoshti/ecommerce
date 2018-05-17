@if(Session :: has('update'))
<div class="col-md-4 alert alert-warning col-md-offset-4">
    <p class="font-weight-bold flash label label-warning"><h5>{{Session :: get('update')}}</h5></p>
</div>
@endif
@if(Session :: has('create'))
<div class="col-md-4 alert alert-success col-md-offset-4">
    <p class="font-weight-bold flash label label-success"><h5>{{Session :: get('create')}}</h5></p>
</div>
@endif
@if(Session :: has('delete'))
<div class="col-md-4 alert alert-danger col-md-offset-4">
    <p class="font-weight-bold flash label label-danger font-weight-bold"><h5>{{Session :: get('delete')}}</h5></p>
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
	.fa-trash{
		color: #EF5350;
	}
	.fa-pencil{
		color: #FFCA28;
	}
	.fa-eye{
		color: #42A5F5;
	}
	.search{
		border-radius: 50px;
		border: 0px;
	}
	.btn{
		border: 0px !important;
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
		display: inline-block
	}
</style>