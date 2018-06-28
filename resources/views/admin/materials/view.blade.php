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
					<td></td>
					<td>
						<button class="btn btn-warning" onclick="location.href='/admin/materials/edit/{{$material->id}}'"><i class="fa fa-pencil fa-lg"></i> Edit</button>
						<button class="btn btn-danger" onclick="location.href='/admin/materials/delete/{{$material->id}}'"><i class="fa fa-trash fa-lg"></i> Delete</button>
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
