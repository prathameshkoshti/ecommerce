@extends('adminlte::page')

@section('title', 'Admin Panel :: Carts')

@section('content_header')
    <center>
		<h2>Carts</h2>
		<br>
    </center>
@stop

@section('content')
<div class="container-fluid">
     <div class="row">
          <div class="col-md-8 col-md-offset-2">
               <table id="user-cart" class="table table-borderless text-center">
                    <thead>
					<tr>
						<th colspan="4">
							<div class="search-wrapper">
								<input class="form-control search"  onkeyup="searchKeyword();" type="text" name="search" id="searchField">
							</div>
						</th>
						<th width=100px>
							<button class="btn btn-primary" onclick="location.href='brands/create'"><i class="fa fa-plus"></i><b> Create</b></button>
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
							No. of Products in Cart
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
					@foreach($users as $user)
					<tr>
						<td>
							{{$user->id}}
						</td>
						<td>
							{{$user->name}}
						</td>
						<td>
							@php
								$count = 0;
								foreach($user->cart as $cart)
								{
									$cart->status == 1 ? $count++ : $count;
								}
							@endphp
							{{$count}}
						</td>
						<td>
							@if($user->status == 1)
								Active
							@else
								Inactive
							@endif
						</td>
						<td>
							<a href="carts/view/{{$user->id}}"><i class="fa fa-eye fa-lg"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
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
@include('layouts.resources')
@stop

@section('js')
<script>
	function searchKeyword() {
		var input, filter, table, tr, td1, td2, i;
		input = document.getElementById("searchField");
		filter = input.value.toUpperCase();
		table = document.getElementById("user-cart");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td1 = tr[i].getElementsByTagName("td")[1];
			if (td1) {
				if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 ) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}
		}
	}
	</script>
@stop