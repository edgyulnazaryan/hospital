@extends('layouts.app')
@section('content')
<style>
.table
{
	font: 14px sans-serif;
	border-radius: 20px;
	border-color: lightgreen;
}
.add_doctor
{
	color: skyblue;
    position: relative;
    bottom: 342px;
    left: 250px;
    width: 300px;
    font-size: 25px;
}
.add_visitor
{
	color: skyblue;
    position: relative;
    bottom: 342px;
    left: 670px;
    width: 300px;
    font-size: 25px;
}
.add_doctor:hover
{
	color: red;
}
.add_visitor:hover
{
	color: red;
}
body
{
	background: #343a40;

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
</style>
@include('navbar')
<a href="{{ route('add_doctors')}}" class="btn  add_doctor" >Ավելացնել նոր բժիշկ</a>
<a href="{{ route('add_patient')}}" class="btn  add_visitor">Ավելացնել նոր այցելու</a>


<div class="container mt-5">
	<div class="mt-4">
			
		<div class="table">
			<table class="table table-dark">
	
					<tr>
						<th>NAME</th>
						<th>SURNAME</th>
						<th>DATE OF BIRTH</th>
						<th>PROFESSION</th>
						<th>EMAIL</th>
						<th>GENDER</th>
						<th>CITY</th>
						<th>PHONE</th>
						<th></th>
					</tr>
	
				<tbody>
					@foreach($data as $value)
					<tr>
						<td>{{ $value->name }}</td>
						<td>{{ $value->surname}}</td>
						<td>{{ $value->date_of_birth}}</td>
						<td>{{ $value->profession}}</td>
						<td>{{ $value->email}}</td>
						<td>{{ $value->gender}}</td>
						<td>{{ $value->city}}</td>
						<td>{{ $value->phone}}</td>
						<td>
							<a href="" class="btn btn-danger ">Ջնջել</a>
							<a href="{{ route('info', $value->id) }}" class="btn btn-primary ">Գրանցվել</a>
							<a href="" class="btn btn-warning ">Փոփոխել</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

	</div>
</div>

@endsection