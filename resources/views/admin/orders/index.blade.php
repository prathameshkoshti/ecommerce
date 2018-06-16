@extends('adminlte::page')

@section('title', 'Admin Panel :: Orders')

@section('content_header')
	<center>
		<h2>Orders</h2>
		<br>
	</center>
@stop

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<table id="orders" class="table table-borderless text-center">
				<thead>
					<tr>
						<th colspan="7">
							<div class="search-wrapper">
								<input placeholder="Search for User Name, Product Name, Shipping City, Delivery Status or Status" class="form-control search"  onkeyup="searchKeyword();" type="text" name="search" id="searchField">
							</div>
						</th>
					</tr>
					<tr>
						<th>
							#
						</th>
						<th>
							Name of User
						</th>
						<th>
							Product Name
						</th>
						<th>
							Shipping City
						</th>
						<th>
							Delivery Status
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
					@foreach($orders as $order)
					<tr>
						<td>
							{{$order->id}}
						</td>
						<td>
							{{$order->user->name}}
						</td>
						<td>
							{{$order->product->name}}
						</td>
						<td>
							{{$order->shipping->city}}
						</td>
						<td>
							@if($order->delivery_status == 0)
								Confirmed
							@elseif($order->delivery_status == 1)
								Dispatched
							@elseif($order->delivery_status == 2)
								Delivered
							@else
								Cancelled
							@endif
						</td>
						<td>
							@if($order->status == 1)
								Active
							@else
								Inactive
							@endif
						</td>
						<td>
							<a href="orders/view/{{$order->id}}"><i class="fa fa-eye fa-lg"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="orders/edit/{{$order->id}}"><i class="fa fa-pencil fa-lg"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="orders/delete/{{$order->id}}"><i class="fa fa-trash fa-lg"></i></a>
						</td>
					</tr>
					@endforeach
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
			var input, filter, table, tr, td1, td2, td3, td4, td5, i;
			input = document.getElementById("searchField");
			filter = input.value.toUpperCase();
			table = document.getElementById("orders");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
				td1 = tr[i].getElementsByTagName("td")[1];
				td2 = tr[i].getElementsByTagName("td")[2];
				td3 = tr[i].getElementsByTagName("td")[3];
				td4 = tr[i].getElementsByTagName("td")[4];
				td5 = tr[i].getElementsByTagName("td")[5];
				if (td1 || td2 || td3 || td4 || td5) {
					if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 ||
						td2.innerHTML.toUpperCase().indexOf(filter) > -1 ||
						td3.innerHTML.toUpperCase().indexOf(filter) > -1 ||
						td4.innerHTML.toUpperCase().indexOf(filter) > -1 ||
						td5.innerHTML.toUpperCase().indexOf(filter) > -1
					) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}
			}
		}
	</script>
@stop