@extends('layouts.app')
@section('content')

<div class="container mt-5" style="max-width: 800px">
    <h2 class="h2 text-center mb-5 border-bottom pb-3">{{$data[0]->name}} {{$data[0]->surname}}</h2>
</div>

<label>CHECK/UNCHECK</label> <input type="checkbox" name="check" id="checkAll">
<form action="{{ route('graph_register', $data[0]->id)}}" method="post">
    @csrf
<input type="number" name="doctor_id" hidden value="{{$data[0]->id}}">
<input type="date" name="date" class="form-control col-2" />
<table class="table table-bordered">
<tr>
    <td>09.00 AM <input type="checkbox" name="time[]" value="09.00"></td>
    <td>09.30 AM <input type="checkbox" name="time[]" value="09.30"></td>
    <td>10.00 AM <input type="checkbox" name="time[]" value="10.00"></td>
    <td>10.30 AM <input type="checkbox" name="time[]" value="10.30"></td>
</tr>

<tr>
    <td>11.00 AM <input type="checkbox" name="time[]" value="11.00"></td>
    <td>11.30 AM <input type="checkbox" name="time[]" value="11.30"></td>
    <td>12.00 AM <input type="checkbox" name="time[]" value="12.00"></td>
    <td>12.30 PM <input type="checkbox" name="time[]" value="12.30"></td>
</tr>

<tr>
    <td>13.00 PM <input type="checkbox" name="time[]" value="13.00"></td>
    <td>13.30 PM <input type="checkbox" name="time[]" value="13.30"></td>
    <td>14.00 PM <input type="checkbox" name="time[]" value="14.00"></td>
    <td>14.30 PM <input type="checkbox" name="time[]" value="14.30"></td>
</tr>

<tr>
    <td>15.00 PM <input type="checkbox" name="time[]" value="15.00"></td>
    <td>15.30 PM <input type="checkbox" name="time[]" value="15.30"></td>
    <td>16.00 PM <input type="checkbox" name="time[]" value="16.00"></td>
    <td>16.30 PM <input type="checkbox" name="time[]" value="16.30"></td>
</tr>


<tr>
    <td>17.00 PM <input type="checkbox" name="time[]" value="17.00"></td>
    <td>17.30 PM <input type="checkbox" name="time[]" value="17.30"></td>
    <td>18.00 PM <input type="checkbox" name="time[]" value="18.00"></td>
    <td>18.30 PM <input type="checkbox" name="time[]" value="18.30"></td>
</tr>
</table>
<button type="submit" class="btn btn-success">Register</button>
</form>

<script>
$(document).ready(function()
{
    

    $("#checkAll").click(function()
    {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
})

</script>
@endsection