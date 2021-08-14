@extends('layouts.app')
@section('content')
<style>
.work-create
{
	width: 30%;
	margin: 0 auto;
}
.work-price
{
	font: 20px italic;
}

body
{
	background: #343a40;

}
label
{
	color: lightgreen;
}
</style>
<div class="container">
	<form action="{{ route('work.create') }}" method="post">
	@csrf
		<h5 align="center" class="text-light">Հարգելի բժիշկ խնդրում ենք մուտաքգրել {{ $event->title }}-ի վրա կատարված պրոցեդուրայի անվանումը և արժեքը</h5>
	<div class="form-group work-create ">
		<input type="number" name="doctor_id" hidden value="{{ $event->doctor_id }}">
		<input type="number" name="visit_id" hidden value="{{ $event->id }}">
		<label>Անվանում</label>
		<input type="text" class="form-control work-price mt-3" name="name"  placeholder="Անվանում">
		<label>Արժեք</label>
		<input type="text" class="form-control work-price mt-3" name="price" placeholder="Արժեք">
	
		<input type="submit" class="btn btn-success btn-block mt-3" value="Submit">
	</div>
	</form>
</div>



@endsection