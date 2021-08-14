@extends('layouts.app')
@section('content')
<style>
body
{
	background: #343a40;

}
label
{
	color: lightgreen;
}
</style>
<div class="container mt-5" style="max-width: 700px">
	<form action="{{ route('add_doctors_form') }}" method="post">
	@csrf
	<div class="form-group">
		<label>Անուն</label>
		<input type="text" class="form-control" name="name" required>
	</div>
	
	<div class="form-group">
		<label>Ազգանուն</label>
		<input type="text" class="form-control" name="surname" required>
	</div>
	
	<div class="form-group">
		<label>Ծննդյան ամիս/օր/տարի</label>
		<input type="date" class="form-control" name="date_of_birth" required>
	</div>
	
	<div class="form-group">
		<label>Մասնագիտություն</label>
		<input type="text" class="form-control" name="profession" required>
	</div>
	
	<div class="form-group">
		<label>Էլ․ հասցե</label>
		<input type="email" class="form-control" name="email" required>
	</div>
	
	<div class="form-group">
		<label>Անձնագիր</label>
		<input type="text" class="form-control" name="passport" required>
	</div>
	
	<div class="form-group">
		<label>Սեռ</label>
		<select name="gender" class="form-control" required>
			<option value="Տղամարդ">Տղամարդ</option>
			<option value="Կին">Կին</option>
		</select>
	</div>
	
	<div class="form-group">
		<label>Քաղաք</label>
		<input type="text" class="form-control" name="city" required>
	</div>
	
	<div class="form-group">
		<label>Հեռախոսահամար</label>
		<input type="phone" class="form-control" name="phone" required>
	</div>
	<button type="submit" class="btn btn-success">Ավելացնել</button>
</form>
</div>
@endsection