@extends('layouts.header')

@section('content')
@php
$eventsQuery = DB::table('events')->get();
$Events = array();
foreach ($eventsQuery as $key => $value) {
    $data = array();
    $data['title'] = $value->title;
    $data['start'] = date("Y-m-d H:i:s",strtotime($value->date." ".$value->time_start));
    $data['end'] = date("Y-m-d H:i:s",strtotime($value->date." ".$value->time_end));
    $data['eventStartEditable'] = false;
    $data['description'] = "Room: 42";
    $Events[] = $data;
}

$Events = json_encode($Events);
// dd($Events);
@endphp
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Student Planner</h1>
</div>
<div class="card shadow animate__animated animate__fadeInRight">
    <div class="card-body">
        <div id='calendar'></div>
    </div> <!-- end card-body-->
</div>

<script>
    
    $(document).ready(function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            hiddenDays: [0],
            allDaySlot: false,
            selectable: true,
            select: function(data) {
                var start = formatDateToTime(data.start);
                var end = formatDateToTime(data.end);
                var date = data.startStr.substring(0, 10);
                var uid = "add";
                $.ajax({
                    type: "POST",
                    url: "{{ url('event/getModal')}}",
                    data: {
                        uid: uid,
                        start: start,
                        end: end,
                        date: date
                    },
                    success: function(response) {
                        $("#modal-view").modal('toggle');
                        $("#modal-view").find(".modal-title").text("Add Event");
                        $("#modal-view").find("#modal-display").html(response);
                    }
                });
            },
            editable: true,
            events: <?php echo $Events?>
            ,
            eventClick: function(calEvent, jsEvent, view) {
                console.log(calEvent);    
            },
            eventDidMount: function(event, element) {
                // To append if is assessment
                if(event.event.extendedProps.description != '' && typeof event.event.extendedProps.description  !== "undefined")
                {  
                    $(event.el).find(".fc-event-title").append("<br/><b>"+event.event.extendedProps.description+"</b>");
                }
            }
        });
        calendar.render();
    });
    
    function formatDateToTime(date) {
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0'+minutes : minutes;
        hours = hours < 10 ? '0'+hours : hours;
        var strTime = hours + ':' + minutes + ' ' + ampm;
        return strTime;
    }
</script>
@endsection
