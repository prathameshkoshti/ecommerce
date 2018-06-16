@extends('adminlte::page')

@section('title', 'Admin Panel :: Categories')

@section('content_header')
    <center>
		<h2>Categories</h2>
		<br>
    </center>
@stop

@section('content')
<div class="container-fluid">
     <div class="row">
          <div class="col-md-8 col-md-offset-2">
               <table id="categories" class="table table-borderless text-center">
                    <thead>
					<tr>
						<th colspan="3">
							<div class="search-wrapper">
								<input  placeholder="Search for Name or Status" class="form-control search"  onkeyup="searchKeyword();" type="text" name="search" id="searchField">
							</div>
						</th>
						<th width=100px>
							<button class="btn btn-primary" onclick="location.href='categories/create'"><i class="fa fa-plus"></i><b> Create</b></button>
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
							Status
						</th>
						<th>
							Actions
						</th>
					</tr>
                    </thead>
                    <tbody>
					@foreach($categories as $category)
					<tr>
						<td>
							{{$category->id}}
						</td>
						<td>
							{{$category->name}}
						</td>
						<td>
							@if($category->status == 1)
								Active
							@else
								Inactive
							@endif
						</td>
						<td>
							<a href="categories/view/{{$category->id}}"><i class="fa fa-eye fa-lg"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="categories/edit/{{$category->id}}"><i class="fa fa-pencil fa-lg"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="categories/delete/{{$category->id}}"><i class="fa fa-trash fa-lg"></i></a>
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
			var input, filter, table, tr, td1, td2, i;
			input = document.getElementById("searchField");
			filter = input.value.toUpperCase();
			table = document.getElementById("categories");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
				td1 = tr[i].getElementsByTagName("td")[1];
				td2 = tr[i].getElementsByTagName("td")[2];
				if (td1 || td2) {
					if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 ||
						td2.innerHTML.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}
			}
		}
	</script>
@stop