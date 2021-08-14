@extends('layouts.app')
@section('content')


<style>

#calendar
{
    width: 80%;
    margin: 0 auto;
    font: 20px sans-serif;
}

</style>

    <div id="calendar"></div>
    <div id="result"></div>


<script>
$(document).ready(function (){

    $.ajaxSetup(
    {
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    
    var doc = []
    var calendar = $('#calendar').fullCalendar(
    {
        defaultView: 'month',
        

        eventRender: function (event, element) 
        {
            element.css('background-color', event['status'])
            doc.push(event['doctor_id'])
        },
        
        

        editable:true,
        header:{
            left:'prev,next, today',
            center: 'title',
            right:'month, agendaWeek,agendaFourDay',
        },
        
        
        events: '{{ route("info_full") }}',
            

             
	});
        
    
        
            


})
</script>



@endsection