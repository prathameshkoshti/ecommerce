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
						<td></td>
						<td>
							<button class="btn btn-warning" onclick="location.href='/admin/sizes/edit/{{$size->id}}'"><i class="fa fa-pencil fa-lg"></i> Edit</button>
							<button class="btn btn-danger" onclick="location.href='/admin/sizes/delete/{{$size->id}}'"><i class="fa fa-trash fa-lg"></i> Delete</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	@include('admin.layouts.resources')
@stop
