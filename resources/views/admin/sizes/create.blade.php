@extends('adminlte::page')

@section('title', 'Admin Panel :: Size')

@section('content_header')
    <center>
		<h2>Create a Size</h2>
		<br>
    </center>
@stop

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form method="POST" action="store">
					<table class="table table-borderless">
						<tr>
							<td>
								Size:
							</td>
							<td>
								<input type="text" name="name" id="" class="form-control">
							</td>
						</tr>
						<tr>
							<td>
								Status:
							</td>
							<td>
								<input type="checkbox" name="status">
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="submit" class="btn btn-success" value="Submit">
							</td>
						</tr>
					</table>
					@method('PUT')
					@csrf
				</form>
			</div>
		</div>
	</div>
	@include('admin.layouts.resources')
@stop
