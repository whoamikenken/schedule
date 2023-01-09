@extends('layouts.header')

@section('content')
@php
$dt = new DateTime();
$dates = [];
for ($d = 1; $d <= 5; $d++) {
    $dt->setISODate($dt->format('o'), $dt->format('W'), $d);
    $dates[$dt->format('N')] = $dt->format('Y-m-d');
}

$Events = array();

if(Auth::user()->user_type != "SUPER ADMIN"){
    if (Auth::user()->username) {
        foreach ($dates as $key => $dateW) {
    
            $eventsQuery = DB::table('schedules_detail_student')->where("idx","=",$key)->where("student_id","=",Auth::user()->username)->get();
            foreach ($eventsQuery as $ky => $value) {
                // dd($value);
                $data = array();
                $data['title'] = DB::table('subjects')->where('id', $value->subject)->value('course_desc');
                $data['start'] = date($dateW." H:i:s",strtotime($dateW." ".$value->starttime));
                $data['end'] = date($dateW." H:i:s",strtotime($dateW." ".$value->endtime));
                $data['eventStartEditable'] = false;
                $data['description'] = "Room: ".$value->room;
                $data['prof'] = "Prof: ".DB::table('users')->where('id', $value->professor)->value('name');
                $Events[] = $data;
            }
            
        }
    }
}


$Events = json_encode($Events);
// dd($Events);
@endphp

<style>
    .fc .fc-non-business {
        background: var(--fc-non-business-color);
        display: none;
    }
</style>
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
            selectOverlap:false,
            selectable: true,
            selectConstraint: 'businessHours',
            businessHours: {
            daysOfWeek: [ 1, 2, 3, 4,5,6], // Monday - Thursday
            startTime: '07:00', // a start time (10am in this example)
            endTime: '20:00', // an end time (6pm in this example)
            },
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
            headerToolbar:{
                start: '', // will normally be on the left. if RTL, will be on the right
                center: '',
                end: '' // will normally be on the right. if RTL, will be on the left
            },
            dayHeaderFormat:{ weekday: 'long' },
            editable: true,
            events: <?php echo $Events?>,
            contentHeight: 680,
            eventClick: function(calEvent, jsEvent, view) {
                console.log(calEvent);    
            },
            viewDidMount: function(event, element) {
                $('td[data-time]').each(function() {
                        var time = $(this).attr("data-time");
                        if(time < "07:00:00"){
                            $(this).parent().remove();
                        }
                        if(time > "19:30:00"){
                            $(this).parent().remove();
                        }
                        console.log($(this).parent());
                });
            },
            eventDidMount: function(event, element) {
                // To append if is assessment
                if(event.event.extendedProps.description != '' && typeof event.event.extendedProps.description  !== "undefined")
                {  
                    $(event.el).find(".fc-event-title").append("<br/><b>"+event.event.extendedProps.description+"</b>");
                    $(event.el).find(".fc-event-title").append("<br/><b>"+event.event.extendedProps.prof+"</b>");
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
