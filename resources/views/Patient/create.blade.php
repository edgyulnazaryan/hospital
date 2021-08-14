@extends('layouts.app')
@section('content')

<div class="container mt-5" style="max-width: 700px">
	<form action="{{ route('add_patient_form') }}" method="post">
	@csrf
	<div class="form-group">
		<label>Անուն</label>
		<input type="text" class="form-control" name="name">
	</div>
	
	<div class="form-group">
		<label>Ազգանուն</label>
		<input type="text" class="form-control" name="surname">
	</div>
	
	<div class="form-group">
		<label>Ծննդյան ամիս/օր/տարի</label>
		<input type="date" class="form-control" name="date_of_birth">
	</div>
	
	<div class="form-group">
		<label>Էլ․ հասցե</label>
		<input type="text" class="form-control" name="email">
	</div>
	
	<div class="form-group">
		<label>Անձնագիր</label>
		<input type="text" class="form-control" name="passport">
	</div>
	
	<div class="form-group">
		<label>Սեռ</label>
		<select name="gender" class="form-control">
			<option value="Տղամարդ">Տղամարդ</option>
			<option value="Կին">Կին</option>
		</select>
	</div>
	
	<div class="form-group">
		<label>Հեռախոսահամար</label>
		<input type="phone" class="form-control" name="phone">
	</div>
	<button type="submit" class="btn btn-success">Ավելացնել</button>
</form>
</div>
@endsection