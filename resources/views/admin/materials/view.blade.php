@extends('adminlte::page')

@section('title', 'Admin Panel :: Materials')

@section('content_header')
    <center>
	 	<h2>Viewing Material: {{$material->name}}</h2>
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
						{{$material->id}}
					</td>
				</tr>
				<tr>
					<td>
						Name:
					</td>
					<td>
						{{$material->name}}
					</td>
				</tr>
				<tr>
					<td>
						Status:
					</td>
					<td>
						{{$material->status == 1 ? 'Active' : 'Inactive'}}
					</td>
				</tr>
				<tr>
					<td>
						Additional Information:
					</td>
					<td>
						Created At: {{$material->created_at}}<br>
						Created By: {{$material->createdBy->name}}<br>
						Updated At: {{$material->updated_at}}<br>
						Updated By: {{$material->updated_by == '' ? 'NULL' : $material->updatedBy->name}}
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
@stop

@section('css')
@include('layouts.resources')
@stop
