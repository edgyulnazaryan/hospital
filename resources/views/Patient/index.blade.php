@extends('layouts.app')
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
thead
{
	color: lightgreen;
}
.table
{
	border-radius: 20px;
	border-color: lightgreen;
}
.table thead tr
{
	border-top: none;
}
.table tr:hover
{
	color: lightgreen;
	cursor: pointer;
}
body{
	background-image: url(https://cdn.hipwallpaper.com/i/88/44/PnDrCd.jpg);
}
.info:hover
{
	text-decoration: none;
}
</style>
<div class="container">
	<div class="mt-4">
			
		<div class="table">
			<table class="table table-dark">
	
					<tr>
						<th>NAME</th>
						<th>SURNAME</th>
						<th>DATE OF BIRTH</th>
						<th>EMAIL</th>
						<th>GENDER</th>
						<th>PHONE</th>
					</tr>
	
				<tbody>
					@foreach($data as $value)
					<tr>
						<td>{{ $value->name }}</td>
						<td>{{ $value->surname }}</td>
						<td>{{ $value->date_of_birth }}</td>
						<td>{{ $value->email }}</td>
						<td>{{ $value->gender }}</td>
						<td>{{ $value->phone }}</td>
						<td><a href="{{route('patient_show', $value->id)}}" class="btn btn-light info"><i class="fa fa-eye" style="font-size:24px;"></i></a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

	</div>
</div>
@endsection