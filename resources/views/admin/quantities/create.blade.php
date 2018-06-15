@extends('adminlte::page')

@section('title', 'Admin Panel :: Size')

@section('content_header')
    <center>
		<h2>Create a new Quantity for a product</h2>
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
								Product Name:
							</td>
							<td>
								<select name="product" class="form-control">
									<option selected disabled>Select a product</option>
									@foreach($products as $product)
									<option value="{{$product->id}}">{{$product->name}}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Size:
							</td>
							<td>
								<select name="size" class="form-control">
									<option selected disabled>Select a size</option>
									@foreach($sizes as $size)
									<option value="{{$size->id}}">{{$size->name}}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Quantity
							</td>
							<td>
								<input type="number" min="0" name="quantity" step="1" class="form-control">
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
