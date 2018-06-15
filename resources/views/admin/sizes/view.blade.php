@extends('adminlte::page')

@section('title', 'Admin Panel :: Size')

@section('content_header')
    <center>
		<h2>viewing Size: {{$size->name}}</h2>
		<br>
    </center>
@stop

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-4">
				<table class="table table-borderless">
					<tr>
						<td>
							Size:
						</td>
						<td>
							{{$size->name}}
						</td>
					</tr>
					<tr>
						<td>
							Status:
						</td>
						<td>
							{{$size->status == 1 ? 'Active' : 'Inactive'}}
						</td>
					</tr>
					<tr>
						<td>
							Additional Information:
						</td>
						<td>
							Created By: {{$size->createdBy->name}}<br>
							Created At: {{$size->created_at}}<br>
							Updated By: {{$size->updatedBy->name}}<br>
							Updated At: {{$size->updated_at}}
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	@include('admin.layouts.resources')
@stop
