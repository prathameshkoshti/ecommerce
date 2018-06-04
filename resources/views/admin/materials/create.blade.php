@extends('adminlte::page')

@section('title', 'Admin Panel :: Materials')

@section('content_header')
    <center>
		<h2>Create a Material</h2>
		<br>
    </center>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
			<form action="store" method="post">
				<table class="table table-borderless">
					<tr>
						<td>
							Name
						</td>
						<td>
							<input type="text" name="name" class="form-control" required>
						</td>
					</tr>
					<tr>
						<td>
							Status
						</td>
						<td>
							<input type="checkbox" name="status">
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
