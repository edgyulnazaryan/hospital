@extends('layouts.app')
@section('content')
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
						<th>DOCTOR</th>
						<th>START</th>
						<th>END</th>
						<th>STATUS</th>
					</tr>
			
				<tbody>
					@foreach($data[0] as $key => $value)
					<tr>
						<td>{{ $data[0]->doctor_id[$key]->name }}</td>
						<td>{{ $value->start }}</td>
						<td>{{ $value->end }}</td>
						<td style="background-color:{{ $value->status }}">
							@if( $value->status  == '#3a87ad')
								<label>Գրանցված է</label>
							@elseif( $value->status  == 'darkorange')
								<label>Ուշանում է</label>
							@elseif( $value->status  == 'darkgray')
								<label>Ավարտված է</label>
							@elseif( $value->status  == 'darkkhaki')
								<label>Սպասարկվում է</label>
							@elseif( $value->status  == 'skyblue')
								<label>Մոտեցել է</label>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

	</div>
</div>


@endsection