@extends('adminlte::page')

@section('title', 'Admin Panel :: Products')

@section('content_header')
    <center>
		<h2>Viewing Product: {{$product->name}}</h2>
		<br>
    </center>
@stop

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<table class="table table-borderless">
					<tr>
						<td>
							Name
						</td>
						<td>
							{{$product->name}}
						</td>
					</tr>
					<tr>
						<td>
							Brand
						</td>
						<td>
							{{$product->brand->name}}
						</td>
					</tr>
					<tr>
						<td>
							Category
						</td>
						<td>
							{{$product->category->name}}
						</td>
					</tr>
					<tr>
						<td>
							Material
						</td>
						<td>
							{{$product->material->name}}
						</td>
					</tr>
					<tr>
						<td>
							Description
						</td>
						<td>
							{{$product->description}}
						</td>
					</tr>
					<tr>
						<td>
							Price
						</td>
						<td>
							<i class="inr">&#8377</i> {{$product->price}}
						</td>
					</tr>
					<tr>
						<td>
							Quantity
						</td>
						<td>
							{{$product->quantity}}
						</td>
					</tr>
					<tr>
						<td>
							Images
						</td>
						<td>
							@for($i=0; $i<count($images); $i++)
								<img class="product-images" width="150px" height="150px" src="{{ url('storage/'.$product->category->name.'/'.$images[$i]) }}" alt="{{$original_image_names[$i]}}"> &nbsp; &nbsp; &nbsp; &nbsp;
							@endfor
						</td>
					</tr>
					<tr>
						<td>
							Status
						</td>
						<td>
							@if($product->status == 1)
								Active
							@else
								Inactive
							@endif
						</td>
					</tr>
					<tr>
						<td>
							Additional Information:
						</td>
						<td>
							Created At: {{$product->created_at}}<br>
							Created By: {{$product->created_by}}<br>
							Updated At: {{$product->updated_at}}<br>
							Updated By: {{$product->updated_by == '' ? 'NULL' : $product->updated_by}}
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
@stop

@section('css')
@include('layouts.resources')
@stop