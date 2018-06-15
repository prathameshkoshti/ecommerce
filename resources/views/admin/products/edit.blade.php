@extends('adminlte::page')

@section('title', 'Admin Panel :: Products')

@section('content_header')
    <center>
		<h2>Editing Product: {{$product->name}}</h2>
		<br>
    </center>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
			<form action="/admin/products/update/{{$product->id}}" method="post" enctype="multipart/form-data">
				<table class="table table-borderless">
					<tr>
						<td>
							Name
						</td>
						<td>
							<input type="text" name="name" value="{{$product->name}}" class="form-control" required>
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
									<option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
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
									<option value="{{$material->id}}"  {{$product->material_id == $material->id ? 'selected' : ''}}>{{$material->name}}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Description
						</td>
						<td>
							<textarea class="form-control" name="description" id="" cols="30" rows="5" required>{{$product->description}}</textarea>
						</td>
					</tr>
					<tr>
						<td>
							Price
						</td>
						<td>
							<div class="col-md-1">
								<i class="inr">$</i>
							</div>
							<div class="col-md-11">
								<input type="number" value="{{$product->price}}" name="price" step="any" class="form-control" required>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							Upload Images
						</td>
						<td>
							@for($i=0; $i<count($images); $i++)
								<img class="product-images" width="150px" height="150px" src="{{ url('storage/'.$product->category->name.'/'.$images[$i]) }}" alt="{{$original_image_names[$i]}}"> &nbsp; &nbsp; &nbsp; &nbsp;
							@endfor
							<div>
								<input type="radio" id="delete" name="upload_images" value="delete">
								<label for="delete">Delete existing images and add new images</label><br>

								<input type="radio" id="add" name="upload_images" value="add">
								<label for="add">Add new images while keeping the old ones</label>

							<input type="file" name="images[]" accept="image/*" multiple>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							Status
						</td>
						<td>
							<input type="checkbox" name="status" {{$product->status == 1 ? 'checked' : ''}}>
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
@include('admin.layouts.resources')
@stop

