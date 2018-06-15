@extends('adminlte::page')

@section('title', 'Admin Panel :: Size')

@section('content_header')
    <center>
		<h2>Quantity Information of Product:{{$quantity->product->name}}</h2>
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
							Product Name:
						</td>
						<td>
							{{$quantity->product->name}}
						</td>
					</tr>
					<tr>
						<td>
							Size:
						</td>
						<td>
							{{$quantity->size->name}}
						</td>
					</tr>
					<tr>
						<td>
							Quantity:
						</td>
						<td>
							{{$quantity->quantity}}
						</td>
					</tr>
					<tr>
						<td>
							Status:
						</td>
						<td>
							{{$quantity->status == 1 ? 'Active' : 'Inactive'}}
						</td>
					</tr>
					<tr>
						<td>
							Additional Information:
						</td>
						<td>
							Created By: {{$quantity->createdBy->name}}<br>
							Created At: {{$quantity->created_at}}<br>
							Updated By: {{$quantity->updatedBy->name}}<br>
							Updated At: {{$quantity->updated_at}}
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	@include('admin.layouts.resources')
@stop
