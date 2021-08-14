@extends('layouts.app')
@section('content')
<style>

.modal  {
  top: 0px;
  right: -10px;
  width: 100px;
  height: 400px;
  color: #fff;
  line-height: 1.25;
  text-align: center;
  text-decoration: none;
  text-indent: 0;
  background: #900;
  border: 2px solid #fff;
  -webkit-border-radius:  26px;
  -moz-border-radius:     26px;
  -o-border-radius:       26px;
  -ms-border-radius:      26px;
  -moz-box-shadow:    1px 1px 5px rgba(0,0,0,0.5);
  -webkit-box-shadow: 1px 1px 5px rgba(0,0,0,0.5);
  box-shadow:         1px 1px 5px rgba(0,0,0,0.5);
}
#calendar
{
    width: 80%;
    margin: 0 auto;
    font: 20px sans-serif;
}
.dot_orange
{
    width: 25px;
    height: 25px;
    border-radius: 15px;
    background-color: #3a87ad;
    position: relative;
    left: 115px;
    bottom:15px;
}

.dot_blue
{
    width: 25px;
    height: 25px;
    border-radius: 15px;
    background-color: darkorange;
    position: relative;
    left: 300px;
    top: 10px;
}

.dot_skyblue
{
    width: 25px;
    height: 25px;
    border-radius: 15px;
    background-color: skyblue;
    position: relative;
    left: 480px;
    bottom: 40px;
}


.dot_khaki
{
    width: 25px;
    height: 25px;
    border-radius: 15px;
    background-color: darkgreen;
    position: relative;
    left: 650px;
    bottom: 65px;    
}

.dot_dark
{
    width: 25px;
    height: 25px;
    border-radius: 15px;
    background-color: darkgray;
    position: relative;
    left: 870px;
    bottom: 90px;

}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

<div id="calendar">

<input type="number" name="doctor_id" value="{{$data[0]->id}}" class='doctor_id' hidden>
<div class="container">

    <div class="dot_blue">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspԳրանցված</div>
    <div class="dot_orange">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspՈւշանում</div>
    <div class="dot_skyblue">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspՄոտեցել</div>
    <div class="dot_khaki">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspՍպասարկվում</div>
    <div class="dot_dark">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspԱվարտված</div>
</div>




<div class="modal">
        <input type="text" name="search" class="form-control col-8" id="search">
        <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                
            </tr>
        </thead>
        <tbody id="result">
        
                
            
        </tbody>
        </table>
</div>
</div>
<div class="modal_div">
<div class="sub-modal">

    <div class="form-group">
        <label>Կարգավիճակ</label>
        <select name="status" class="status form-control">
            <option value="darkgreen" style="background-color:darkgreen; color:black;">Սպասարկվում է</option>
            <option value="skyblue" style="background-color:skyblue; color:black;">Մոտեցել է</option>
            <option value="darkorange" style="background-color:darkorange; color:black;">Ուշանում է</option>
            <option value="darkgray" style="background-color:darkgray; color:black;">Ավարտված է</option>
        </select>
    </div>
    
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-success change_status btn-block" value="Change status">
    </div>

</div>
</div>

<script>
$(document).ready(function () 
{

    $(".modal_div").hide();

    $.ajaxSetup(
    {

        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar(
    {
        eventRender: function (event, element) 
        {
            console.log(element.css('background-color', event['status']))
        },
        eventTimeFormat: 
        { 
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        },
        editable:true,
        header:{
            left:'prev,next, today',
            center:'title',
            right:'month, agendaWeek,agendaDay'
        },
        
        events:'{{ route("ajax", $data[0]->id) }}',
        selectable:true,
        selectHelper: true,
        
        select:function(start, end, allDay)
        {
            
             
            $(".modal").modal(
            {
                closeExisting: false,
                fadeDuration: 1000,
                fadeDelay: 0.50,
                closeClass: 'icon-remove',
                closeText: '!',
            });

            $("#search").keyup(function()
            {
                var txt = $(this).val();
                if (txt != '') 
                {
                    $.ajax({
                        url:'{{ route("action", $data[0]->id) }}',
                        method:'post',
                        dataType: "text",
                        data: {
                            search:txt,
                            type: 'search',
                        },
                        success: function(data)
                        {
                            $("#result").html('')
                            data = JSON.parse(data)

                            for(i=0; i<data.length; i++)
                            {

                                $("#result").append('<tr data-title='+data[i]['id']+'><td>'+data[i]['id']+'</td><td class="data-title" >'+data[i]['name']+'</td><td>'+data[i]['surname']+'</td><td><button class="btn btn-success title">Գրանցել</button></td></tr>');
                            }
                        }
                    })
                } 
                else 
                {

                    $("#result").html('');
                }
            })
            
            var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
            $(document).on('click', '.title', function()
            {
                var title = $(this).parent().parent().attr('data-title');
                    var doctor_id = $(".doctor_id").val();
                    status = '#3a87ad',

                    $.ajax({
                        url:'{{ route("action", $data[0]->id) }}',
                        type:"POST",
                        data:{
                            title: title,
                            start: start,
                            end: end,
                            doctor_id: doctor_id,
                            status: status,
                            type: 'add'
                        },
                        success:function(data)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Created Successfully");
                            location.reload();
                        }
                    })

            })
        },
        editable:true,
        eventResize: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var doctor_id = $(".doctor_id").val();
            var title = event.title;
            var id = event.id;
            var status = $('.status').val();

            $.ajax({
                url:'{{ route("action", $data[0]->id) }}',
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    status: status,
                    doctor_id: doctor_id,
                    type: 'update'
                },
                success:function(response)
                {

                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })
        },

        eventDrop: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var doctor_id = $(".doctor_id").val();
            var title = event.title;
            var id = event.id;
            
            $.ajax({
                url:'{{ route("action", $data[0]->id) }}',
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    doctor_id: doctor_id,
                    
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })

        },

            
        eventClick:function(event)
        {
            if(confirm("Are you sure you want to remove it?"))
            {
                var id = event.id;
                $.ajax({
                    url:'{{ route("action", $data[0]->id) }}',
                    type:"POST",
                    data:{
                        id:id,
                        type:"delete"
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Deleted Successfully");
                    }
                })
            }
            else
            {
                var doctor_id = $(".doctor_id").val();
                var patient_id = event.title;
                var id = event.id;
                var status = $('.status').val();

                
                $.ajax(
                {
                    url:'{{ route("action", $data[0]->id) }}',
                    type:"POST",
                    data:{
                        id:id,
                        patient_id:patient_id,
                        doctor_id:doctor_id,
                        type:"about"
                    },
                    success:function(response)
                    {
                        $(".sub-modal").modal(
                        {
                            closeExisting: false,
                            fadeDuration: 1000,
                            fadeDelay: 0.50,
                            closeClass: 'icon-remove',
                            closeText: '!', 
                        });
                    }
                });

                $(document).on('click', '.change_status', function()
                {
                    var id = event.id;
                    var doctor_id = $(".doctor_id").val();
                    var status = $('.status').val();
                    
                    if (status == 'darkgray') 
                    {
                        status = 'darkgray'
                        $.ajax({
                                url:'{{ route("action", $data[0]->id) }}',
                                type:"POST",
                                data:
                                {
                                    id: id,
                                    status: status,
                                    type: 'change_status',
                                },
                                success:function(data)
                                {
                                    window.location.href = "/work/"+event.id
                                }
                            })
                    }
                    else
                    {
                        $.ajax({
                                url:'{{ route("action", $data[0]->id) }}',
                                type:"POST",
                                data:
                                {
                                    id: id,
                                    status: status,
                                    type: 'change_status',
                                },
                                success:function(data)
                                {
                                    calendar.fullCalendar('refetchEvents');
                                    alert("Event Status changed successfully");
                                    location.reload();
                                }
                            })
                    }
                            

                })
            }
            
        }
    })
})

</script>
@endsection