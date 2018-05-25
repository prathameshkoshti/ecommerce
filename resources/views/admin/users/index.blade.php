@extends('adminlte::page')

@section('title', 'Admin Panel :: Users')

@section('content_header')
    <center>
		<h2>Users</h2>
		<br>
    </center>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table id="user" class="table table-borderless text-center">
                <thead>
					<tr>
						<th colspan="4">
							<input class="form-control search"  onkeyup="searchKeyword();" type="text" name="search" id="searchField">
						</th>
						<th>
							<button class="btn btn-primary" onclick="location.href='users/create'"><i class="fa fa-plus"></i><b> Create</b></button>
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
							Email
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
							{{$user->email}}
						</td>
						<td>
							@if($user->status == 1)
								Active
							@else
								Inactive
							@endif
						</td>
						<td>
							<a href="users/view/{{$user->id}}"><i class="fa fa-eye fa-lg"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="users/edit/{{$user->id}}"><i class="fa fa-pencil fa-lg"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="users/delete/{{$user->id}}"><i class="fa fa-trash fa-lg"></i></a>
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
@include('layouts.resources')
@stop

@section('js')
<script>
	function searchKeyword() {
		var input, filter, table, tr, td1, td3,i;
		input = document.getElementById("searchField");
		filter = input.value.toUpperCase();
		table = document.getElementById("user");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td1 = tr[i].getElementsByTagName("td")[1];
			td3 = tr[i].getElementsByTagName("td")[2];
			if (td1 || td3) {
				if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td3.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}
		}
	}
</script>
@stop