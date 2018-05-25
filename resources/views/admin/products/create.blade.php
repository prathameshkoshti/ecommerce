@extends('adminlte::page')

@section('title', 'Admin Panel :: Products')

@section('content_header')
    <center>
		<h2>Create a Product</h2>
		<br>
    </center>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
			<form action="store" method="post" enctype="multipart/form-data">
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
							Category
						</td>
						<td>
							<select class="form-control" name="category" required>
									<option selected disabled>Select one</option>
								@foreach($categories as $category)
									<option value="{{$category->id}}">{{$category->name}}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Matrial
						</td>
						<td>
							<select class="form-control" name="material" required>
									<option selected disabled>Select one</option>
								@foreach($materials as $material)
									<option value="{{$material->id}}">{{$material->name}}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Brand
						</td>
						<td>
							<select class="form-control" name="brand" required>
									<option selected disabled>Select one</option>
								@foreach($brands as $brand)
									<option value="{{$brand->id}}">{{$brand->name}}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Description
						</td>
						<td>
							<textarea class="form-control" name="description" id="" cols="30" rows="5" required></textarea>
						</td>
					</tr>
					<tr>
						<td>
							Price
						</td>
						<td>
							<input type="number" name="price" id="" class="form-control" step="any"  min="0.00" required>
						</td>
					</tr>
					<tr>
						<td>
							Quantity
						</td>
						<td>
							<input type="range" class="slider" name="quantity" id="quantityRange" value="10" min="0" max="100" oninput="quantityOutput.value = quantityRange.value">
							<output name="quantityOutputName" id="quantityOutput">10</output>
						</td>
					</tr>
					<tr>
						<td>
							Upload Images
						</td>
						<td>
							<input type="file" name="images[]" accept="image/*" multiple>
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
							<div class="slider-container">
								<input type="submit" name="submit" value="Submit" class="btn btn-success">
							</div>
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
@include('layouts.resources')
@stop

