@extends('layouts.app')
@section('content')
<style>
.add_procedur
{
	position: relative;
    left: 400px;
    top: 38px;
}
</style>
<table class="table table-hover">
<tbody>
@foreach($visit as $value)
<tr>
	<td>{{ $value->patient_id  }}</td>
	<td>{{ $value->status      }}</td>
	<td>{{ $value->date        }}</td>
	<td>{{ $value->time        }}</td>
	<td>{{ $value->work_id     }}</td>

</tr>
@endforeach
</tbody>
</table>

<div class="container mt-5" style="max-width: 700px">
	<form action="{{ route('create_visit_form') }}" method="post">
	@csrf
	<div class="form-group">
		<label>Բժշկի անուն, ազգանուն</label>
		<input name="doctor_id" value="{{$doctor[0]->id}}" hidden >
		<h5><label>{{ $doctor[0] -> name }} {{ $doctor[0] -> surname }}</label></h5>
	</div>
	<div class="form-group">
		<label>Պացիենտի անուն, ազգանունը</label>
		<select name="patient_id" class="form-control">
		@foreach($patient as $value)
			<option value="{{ $value->id }}"> {{ $value -> name }} {{ $value -> surname }}  </option>
		@endforeach
		</select>
	</div>
	<div class="form-group">
		<label>Կարգավիճակը (նախնական գրանցման ժամանակ, միայն << ԳՐԱՆՑՎԱԾ Է >>)</label>
		<select name="status" class="form-control">
			<option value="Գրանցվել է">Գրանցել</option>
			<option value="Ուշանում է" disabled>Ուշանում է</option>
			<option value="Մոտեցել է" disabled>Մոտեցել է</option>
			<option value="Սպասարկում է" disabled>Սպասարկում է</option>
			<option value="Ավարտված է" disabled>Ավարտված է</option>

		</select>
	</div>
	<div class="form-group">
		<label>Ընտրեք ամսաթիվը</label>
		<input type="date" name="date" id="datePicker" class="form-control">
	</div>
	
	<div class="form-group">
		<label>Ընտրեք ժամը</label>
		<input type="text" name="time" id="timefield" class="form-control">
	</div>

	<div class="form-group">
		<label>Ընտրեք պրոցեդուրայի անվանումը</label>
		<a href="{{ route('work') }}" class="btn btn-dark add_procedur">+</a>
		<select name="work_id" class="form-control">
		@foreach($work as $value)
			<option value="{{ $value->id }}">{{ $value->name }}</option>
		@endforeach
		</select>

	</div>
	<input type="submit" class="btn btn-success btn-block" value=" Ավելացնել">
	
	</form>
</div>

<script>
$(document).ready(function() 
{
	var now = new Date();
	
    var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);

	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

	$('#datePicker').val(today);
	
	$('#datePicker').attr({"min":today})

	
	var time = now.getHours() + ":" + now.getMinutes();

	// $('#timefield').attr({"min": time, "value":time})
	$('#timefield').timepicker({
		timeFormat: 'h:mm p',
	    interval: 30,
	    minTime: '10.00am',
	    maxTime: '6:00pm',
	    defaultTime: time,
	    startTime: '10:00',
	    dynamic: false,
	    dropdown: true,
	    scrollbar: true
	});
})

</script>
@endsection