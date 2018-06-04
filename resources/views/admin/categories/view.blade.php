@extends('adminlte::page')

@section('title', 'Admin Panel :: Categories')

@section('content_header')
    <center>
	 	<h2>Viewing Cateory: {{$category->name}}</h2>
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
						{{$category->id}}
					</td>
				</tr>
				<tr>
					<td>
						Name:
					</td>
					<td>
						{{$category->name}}
					</td>
				</tr>
				<tr>
					<td>
						Status:
					</td>
					<td>
						{{$category->status == 1 ? 'Active' : 'Inactive'}}
					</td>
				</tr>
				<tr>
					<td>
						Additional Information:
					</td>
					<td>
						Created At: {{$category->created_at}}<br>
						Created By: {{$category->createdBy->name}}<br>
						Updated At: {{$category->updated_at}}<br>
						Updated By: {{$category->updated_by == '' ? 'NULL' : $category->updatedBy->name}}
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
