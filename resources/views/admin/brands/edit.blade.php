@extends('adminlte::page')

@section('title', 'Admin Panel :: Brands')

@section('content_header')
    <center>
		<h2>Editing Brand: {{$brand->name}}</h2>
		<br>
    </center>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
			<form action="/admin/brands/update/{{$brand->id}}" method="post">
				<table class="table table-borderless">
					<tr>
						<td>
							Name
						</td>
						<td>
							<input type="text" name="name" class="form-control" value="{{$brand->name}}" required>
						</td>
					</tr>
					<tr>
						<td>
							Status
						</td>
						<td>
							@if($brand->status == 1)
								<input type="checkbox" name="status" checked>
							@else
								<input type="checkbox" name="status">
							@endif
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit" value="Submit" class="btn btn-success">
						</td>
					</tr>
				</table>
				@csrf
				@method('PUT')
			</form>
		</div>
	</div>
</div>
@stop

@section('css')
@include('admin.layouts.resources')
@stop
