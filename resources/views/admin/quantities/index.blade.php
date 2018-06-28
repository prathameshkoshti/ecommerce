@extends('adminlte::page')

@section('title', 'Admin Panel :: Sizes')

@section('content_header')
    <center>
		<h2>Quantities</h2>
		<br>
    </center>
@stop

@section('content')
<div class="container-fluid">
     <div class="row">
          <div class="col-md-8 col-md-offset-2">
               <table id="materials" class="table table-borderless text-center">
                    <thead>
					<tr>
						<th colspan="5">
							<div class="search-wrapper">
								<input placeholder="Search for Product Name, Size or Status" class="form-control search"  onkeyup="searchKeyword();" type="text" name="search" id="searchField">
							</div>
						</th>
						<th width=100px>
							<button class="btn btn-primary" onclick="location.href='quantities/create'"><i class="fa fa-plus"></i><b> Create</b></button>
						</th>
					</tr>
					<tr>
						<th>
							#
						</th>
						<th>
							Product Name
						</th>
						<th>
							Size
						</th>
						</th>
						<th>
							Quantity
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
					@foreach($quantities as $quantity)
					<tr>
						<td>
							{{$quantity->id}}
						</td>
						<td>
							{{$quantity->product->name}}
						</td>
						<td>
							{{$quantity->size->name}}
						</td>
						<td>
							{{$quantity->quantity}}
						</td>
						<td>
							@if($quantity->status == 1)
								Active
							@else
								Inactive
							@endif
						</td>
						<td>
							<a href="quantities/view/{{$quantity->id}}"><i class="fa fa-eye fa-lg"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="quantities/edit/{{$quantity->id}}"><i class="fa fa-pencil fa-lg"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="quantities/delete/{{$quantity->id}}"><i class="fa fa-trash fa-lg"></i></a>
						</td>
						@endforeach
					</tr>
                    </tbody>
				</table>

				<div class="pagination-wrapper" style="text-center">
					<div class="paginate">
						{{$quantities->render()}}
					</div>
				</div>
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
		var input, filter, table, tr, td1, td2, td3, i;
		input = document.getElementById("searchField");
		filter = input.value.toUpperCase();
		table = document.getElementById("materials");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td1 = tr[i].getElementsByTagName("td")[1];
			td2 = tr[i].getElementsByTagName("td")[2];
			td3 = tr[i].getElementsByTagName("td")[4];
			if (td1 || td2 || td3) {
				if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 ||
					td2.innerHTML.toUpperCase().indexOf(filter) > -1 ||
					td3.innerHTML.toUpperCase().indexOf(filter) > -1 ) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}
		}
	}
	</script>
@stop