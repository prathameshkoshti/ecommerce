@extends('adminlte::page')

@section('title', 'Admin Panel :: Products')

@section('content_header')
    <center>
		<h2>Products</h2>
		<br>
    </center>
@stop

@section('content')
<div class="container-fluid">
     <div class="row">
          <div class="col-md-8 col-md-offset-2">
               <table id="products" class="table table-borderless text-center">
                    <thead>
					<tr>
						<th colspan="6">
							<div class="search-wrapper">
								<input class="form-control search"  onkeyup="searchKeyword();" type="text" name="search" id="searchField">
							</div>
						</th>
						<th width=100px>
							<button class="btn btn-primary" onclick="location.href='products/create'"><i class="fa fa-plus"></i><b> Create</b></button>
						</th>
					</tr>
					<tr>
						<th>
							#
						</th>
						<th>
							Name
						</th>
						<th>
							Brand
						</th>
						<th>
							Category
						</th>
						<th>
							Material
						</th>
						<th>
							Status
						</th>
						<th>
							Actions
						</th>
					</tr>
                    </thead>
                    <tbody>
					@foreach($products as $product)
					<tr>
						<td>
							{{$product->id}}
						</td>
						<td>
							{{$product->name}}
						</td>
						<td>
							{{$product->brand->name}}
						</td>
						</td>
						<td>
							{{$product->category->name}}
						</td>
						</td>
						<td>
							{{$product->material->name}}
						</td>
						<td>
							@if($product->status == 1)
								Active
							@else
								Inactive
							@endif
						</td>
						<td>
							<a href="products/view/{{$product->id}}"><i class="fa fa-eye fa-lg"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="products/edit/{{$product->id}}"><i class="fa fa-pencil fa-lg"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="products/delete/{{$product->id}}"><i class="fa fa-trash fa-lg"></i></a>
						</td>
						@endforeach
					</tr>
                    </tbody>
                  </table>
          </div>
     </div>
</div>
@stop

@section('css')
@include('admin.layouts.resources')
@stop

@section('js')
<script>
	function searchKeyword() {
		var input, filter, table, tr, td1, td2, t3, t4, i;
		input = document.getElementById("searchField");
		filter = input.value.toUpperCase();
		table = document.getElementById("products");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td1 = tr[i].getElementsByTagName("td")[1];
			td2 = tr[i].getElementsByTagName("td")[2];
			td3 = tr[i].getElementsByTagName("td")[3];
			td4 = tr[i].getElementsByTagName("td")[4];
			if (td1 || td2 || td3 || td4) {
				if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1
				|| td3.innerHTML.toUpperCase().indexOf(filter) > -1 || td4.innerHTML.toUpperCase().indexOf(filter) > -1 ) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}
		}
	}
	</script>
@stop