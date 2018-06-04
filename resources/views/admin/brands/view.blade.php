@extends('adminlte::page')

@section('title', 'Admin Panel :: Brands')

@section('content_header')
    <center>
	 	<h2>Viewing Brand: {{$brand->name}}</h2>
		<br>
    </center>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
			<table class="table table-borderless">
				<tr>
					<td>
						ID:
					</td>
					<td>
						{{$brand->id}}
					</td>
				</tr>
				<tr>
					<td>
						Name:
					</td>
					<td>
						{{$brand->name}}
					</td>
				</tr>
				<tr>
					<td>
						Status:
					</td>
					<td>
						{{$brand->status == 1 ? 'Active' : 'Inactive'}}
					</td>
				</tr>
				<tr>
					<td>
						Additional Information:
					</td>
					<td>
						Created At: {{$brand->created_at}}<br>
						Created By: {{$brand->createdBy->name}}<br>
						Updated At: {{$brand->updated_at}}<br>
						Updated By: {{$brand->updated_by == '' ? 'NULL' : $brand->updatedBy->name}}
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
@stop

@section('css')
@include('admin.layouts.resources')
@stop
