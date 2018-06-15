@extends('adminlte::page')

@section('title', 'Admin Panel :: Size')

@section('content_header')
    <center>
		<h2>Update Information for Product:{{$quantity->product->name}}</h2>
		<br>
    </center>
@stop

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<form method="POST" action="/admin/quantities/update/{{$quantity->id}}">
					<table class="table table-borderless">
						<tr>
							<td>
								Product Name:
							</td>
							<td>
								<select name="product" class="form-control">
									<option selected disabled>Select a product</option>
									@foreach($products as $product)
									<option value="{{$product->id}}" {{$product->id == $quantity->product_id ? 'selected' : ''}}>{{$product->name}}</option>
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
									<option value="{{$size->id}}" {{$size->id == $quantity->size_id ? 'selected' : ''}}>{{$size->name}}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Quantity
							</td>
							<td>
								<input type="number" value="{{$quantity->quantity}}" min="0" name="quantity" step="1" class="form-control">
							</td>
						</tr>
						<tr>
							<td>
								Status
							</td>
							<td>
								<input type="checkbox" name="status" {{$quantity->status == 1 ? 'checked' : ''}}>
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
